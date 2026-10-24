<?php

namespace App\Http\Controllers;

use App\Models\Livraria;
use App\Models\CategoriaLivro;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivrariaController extends Controller
{

    public function index()
    {
        $dados = Livraria::with(['categoriaLivro', 'hashtags', 'ebook', 'avaliacoes'])
            ->orderBy('id', 'desc')
            ->get();
        return view('livraria.list', compact('dados'));
    }

    public function create()
    {
        $categorias = CategoriaLivro::orderBy('categoria')->get();
        $hashtags = Hashtag::orderBy('tag')->get();
        return view('livraria.form', compact('categorias', 'hashtags'));
    }

  
    private function validateForm(Request $request, ?int $id = null)
    {
        $uniqueRule = 'unique:livraria,nome' . ($id ? ",$id,id" : '');

        $request->validate([
            'nome' => ['required', 'string', 'max:255', $uniqueRule],
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categoria_livros,id',
            'autor' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:100',
            'sinopse' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'hashtags' => 'nullable|array',
            'hashtags.*' => 'exists:hashtags,id',
        ], [
            'nome.required' => 'O título do livro é obrigatório.',
            'nome.unique' => 'Já existe um livro cadastrado com este título no acervo. Evite duplicidades.',
            'valor.required' => 'O valor do livro é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número válido.',
            'categoria_id.required' => 'Selecione uma categoria para o livro.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'imagem.image' => 'O arquivo da capa deve ser uma imagem válida.',
            'imagem.mimes' => 'A capa deve estar nos formatos: JPEG, PNG, JPG, WEBP ou GIF.',
            'imagem.max' => 'A imagem da capa não pode ser maior que 2MB.',
        ]);
    }

    /**
     
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        $dados = $request->except(['imagem', 'hashtags']);

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $dados['imagem'] = $request->file('imagem')->store('livros', 'public');
        }

        $livro = Livraria::create($dados);

        if ($request->has('hashtags')) {
            $livro->hashtags()->sync($request->input('hashtags'));
        }

        return redirect()->route('livraria.index')->with('success', 'Livro cadastrado com sucesso!'); 
    }

    /**
     * 
     */
    public function edit(int $id)
    {
        $data = Livraria::with('hashtags')->findOrFail($id);
        $categorias = CategoriaLivro::orderBy('categoria')->get();
        $hashtags = Hashtag::orderBy('tag')->get();
        return view('livraria.form', compact('data', 'categorias', 'hashtags'));
    }

    /**
     *
     */
    public function update(Request $request, int $id)
    {
        $this->validateForm($request, $id);

        $livro = Livraria::findOrFail($id);
        $dados = $request->except(['imagem', 'remover_imagem', 'hashtags']);

        // se o usuário optou por remover a imagem atual
        if ($request->has('remover_imagem') && $livro->imagem) {
            if (Storage::disk('public')->exists($livro->imagem)) {
                Storage::disk('public')->delete($livro->imagem);
            }
            $dados['imagem'] = null;
        }

        // se uma nova capa foi enviada, substitui o arquivo antigo
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($livro->imagem && Storage::disk('public')->exists($livro->imagem)) {
                Storage::disk('public')->delete($livro->imagem);
            }
            $dados['imagem'] = $request->file('imagem')->store('livros', 'public');
        }

        $livro->update($dados);

            $livro->hashtags()->sync($request->input('hashtags', []));

        return redirect()->route('livraria.index')->with('success', 'Registro atualizado com sucesso!');
    }


    public function destroy(int $id)
    {
        $livro = Livraria::find($id);

        if ($livro) {
            if ($livro->imagem && Storage::disk('public')->exists($livro->imagem)) {
                Storage::disk('public')->delete($livro->imagem);
            }
            $livro->delete();
        }

        return redirect()->route('livraria.index')->with('success', 'Livro e imagem da capa removidos com sucesso!');
    }


    public function search(Request $request)
    {
        $tipo = $request->input('tipo', 'nome');
        $valor = $request->input('valor');

        $query = Livraria::with(['categoriaLivro', 'hashtags', 'ebook', 'avaliacoes']);

        if (!empty($valor)) {
            if ($tipo === 'categoria') {
                $query->whereHas('categoriaLivro', function ($q) use ($valor) {
                    $q->where('categoria', 'like', "%{$valor}%");
                });
            } elseif ($tipo === 'hashtag') {
                $query->whereHas('hashtags', function ($q) use ($valor) {
                    $q->where('tag', 'like', "%{$valor}%");
                });
            } else {
                $campo = in_array($tipo, ['nome', 'autor', 'genero', 'sinopse']) ? $tipo : 'nome';
                $query->where($campo, 'like', "%{$valor}%");
            }
        }

        $dados = $query->orderBy('id', 'desc')->get();

        return view('livraria.list', compact('dados'));
    }
}
