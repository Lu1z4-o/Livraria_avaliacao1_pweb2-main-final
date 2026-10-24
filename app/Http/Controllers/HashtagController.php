<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\Livraria;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    /**
     * Lista todas as hashtags cadastradas com seus livros vinculados (N:N)
     */
    public function index(Request $request)
    {
        $query = Hashtag::with('livros');

        // Permite filtrar as hashtags associadas a um livro específico
        if ($request->filled('livro_id')) {
            $query->whereHas('livros', function ($q) use ($request) {
                $q->where('livraria.id', $request->livro_id);
            });
        }

        $dados = $query->orderBy('id', 'desc')->get();
        $livros = Livraria::orderBy('nome')->get();
        $filtroLivroId = $request->get('livro_id');

        return view('hashtag.list', compact('dados', 'livros', 'filtroLivroId'));
    }


    public function create(Request $request)
    {
        $livros = Livraria::orderBy('nome')->get();
        $selectedLivroId = $request->get('livro_id');

        return view('hashtag.form', compact('livros', 'selectedLivroId'));
    }

    private function validateForm(Request $request, ?int $id = null)
    {
        $uniqueRule = 'unique:hashtags,tag' . ($id ? ",$id,id" : '');

        $request->validate([
            'tag' => ['required', 'string', 'max:100', $uniqueRule],
            'tipo' => 'required|string|max:60',
            'descricao' => 'nullable|string|max:500',
            'cor' => 'nullable|string|max:30',
            'livros' => 'nullable|array',
            'livros.*' => 'exists:livraria,id',
        ], [
            'tag.required' => 'O campo Hashtag (#) é obrigatório.',
            'tag.unique' => 'Esta hashtag já está cadastrada. Você pode associá-la a múltiplos livros!',
            'tipo.required' => 'Informe a classificação ou tipo do tropo literário.',
        ]);
    }


    public function store(Request $request)
    {
        $this->validateForm($request);

        $dados = $request->except(['livros']);
        if (empty($dados['cor'])) {
            $dados['cor'] = '#8C5A3C';
        }

        $hashtag = Hashtag::create($dados);

        if ($request->has('livros')) {
            $hashtag->livros()->sync($request->input('livros'));
        }

        return redirect()->route('hashtag.index')->with('success', 'Hashtag cadastrada com sucesso e vinculada aos livros selecionados!');
    }

   
    public function edit(int $id)
    {
        $data = Hashtag::with('livros')->findOrFail($id);
        $livros = Livraria::orderBy('nome')->get();

        return view('hashtag.form', compact('data', 'livros'));
    }

    public function update(Request $request, int $id)
    {
        $this->validateForm($request, $id);

        $hashtag = Hashtag::findOrFail($id);
        $dados = $request->except(['livros']);

        $hashtag->update($dados);
        $hashtag->livros()->sync($request->input('livros', []));

        return redirect()->route('hashtag.index')->with('success', 'Hashtag atualizada com sucesso!');
    }


    public function destroy(int $id)
    {
        Hashtag::destroy($id);

        return redirect()->route('hashtag.index')->with('success', 'Hashtag removida com sucesso!');
    }

   
    public function search(Request $request)
    {
        $tipo = $request->input('tipo', 'tag');
        $valor = $request->input('valor');

        $query = Hashtag::with('livros');

        if (!empty($valor)) {
            if ($tipo === 'livro') {
                $query->whereHas('livros', function ($q) use ($valor) {
                    $q->where('nome', 'like', "%{$valor}%");
                });
            } else {
                $campo = in_array($tipo, ['tag', 'tipo', 'descricao']) ? $tipo : 'tag';
                $query->where($campo, 'like', "%{$valor}%");
            }
        }

        $dados = $query->orderBy('id', 'desc')->get();
        $livros = Livraria::orderBy('nome')->get();
        $filtroLivroId = null;

        return view('hashtag.list', compact('dados', 'livros', 'filtroLivroId'));
    }
}
