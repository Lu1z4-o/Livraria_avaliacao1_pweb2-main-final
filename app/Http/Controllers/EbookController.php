<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Livraria;
use Illuminate\Http\Request;

class EbookController extends Controller
{
  
    public function index()
    {
        $dados = Ebook::with('livro')->orderBy('id', 'desc')->get();
        return view('ebook.list', compact('dados'));
    }

    public function create()
    {
        $livros = Livraria::whereDoesntHave('ebook')->orderBy('nome')->get();
        return view('ebook.form', compact('livros'));
    }

    private function validateForm(Request $request, ?int $id = null)
    {
        $uniqueLivro = 'unique:ebooks,livro_id' . ($id ? ",$id,id" : '');

        $request->validate([
            'livro_id' => ['required', 'exists:livraria,id', $uniqueLivro],
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'numero_de_paginas' => 'required|integer|min:1',
            'sinopse' => 'required|string',
            'tamanho_do_arquivo' => 'required|string|max:50',
        ], [
            'livro_id.required' => 'Selecione o livro físico vinculado.',
            'livro_id.unique' => 'Este livro já possui um E-book cadastrado (Relação 1:1). Cada obra física pode ter apenas um exemplar digital.',
            'livro_id.exists' => 'O livro selecionado não existe no acervo.',
            'titulo.required' => 'O título do e-book é obrigatório.',
            'autor.required' => 'O nome do autor é obrigatório.',
            'editora.required' => 'A editora do e-book é obrigatória.',
            'numero_de_paginas.required' => 'O número de páginas é obrigatório.',
            'numero_de_paginas.integer' => 'O número de páginas deve ser um número inteiro positivo.',
            'sinopse.required' => 'A sinopse do e-book é obrigatória.',
            'tamanho_do_arquivo.required' => 'O tamanho do arquivo digital (ex: 2.5 MB) é obrigatório.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Ebook::create($request->all());

        return redirect()->route('ebook.index')->with('success', 'E-book digital cadastrado com sucesso (Relação 1:1)!');
    }

    public function edit(int $id)
    {
        $data = Ebook::with('livro')->findOrFail($id);
        $livros = Livraria::whereDoesntHave('ebook')->orWhere('id', $data->livro_id)->orderBy('nome')->get();

        return view('ebook.form', compact('data', 'livros'));
    }


    public function update(Request $request, int $id)
    {
        $this->validateForm($request, $id);

        $ebook = Ebook::findOrFail($id);
        $ebook->update($request->all());

        return redirect()->route('ebook.index')->with('success', 'E-book atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        Ebook::destroy($id);

        return redirect()->route('ebook.index')->with('success', 'E-book removido com sucesso!');
    }

    public function search(Request $request)
    {
        $tipo = $request->input('tipo', 'titulo');
        $valor = $request->input('valor');

        $query = Ebook::with('livro');

        if (!empty($valor)) {
            if ($tipo === 'livro') {
                $query->whereHas('livro', function ($q) use ($valor) {
                    $q->where('nome', 'like', "%{$valor}%");
                });
            } else {
                $campo = in_array($tipo, ['titulo', 'autor', 'editora', 'sinopse', 'tamanho_do_arquivo']) ? $tipo : 'titulo';
                $query->where($campo, 'like', "%{$valor}%");
            }
        }

        $dados = $query->orderBy('id', 'desc')->get();

        return view('ebook.list', compact('dados'));
    }
}
