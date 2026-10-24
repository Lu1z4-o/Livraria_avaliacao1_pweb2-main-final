<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Livraria;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    
    public function index()
    {
        $dados = Avaliacao::with('livro')->orderBy('id', 'desc')->get(); 
        return view('avaliacao.list', compact('dados'));
    }

   
    public function create(Request $request)
    {
        $livros = Livraria::orderBy('nome')->get();
        $selectedLivroId = $request->get('livro_id');
        return view('avaliacao.form', compact('livros', 'selectedLivroId'));
    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livraria,id',
            'avaliacao' => 'required|string|min:10',
            'autor' => 'nullable|string|max:100',
            'data' => 'nullable|date',
        ], [
            'livro_id.required' => 'Selecione o livro que você está avaliando.',
            'livro_id.exists' => 'O livro selecionado não existe em nosso catálogo.',
            'avaliacao.required' => 'O texto da avaliação é obrigatório.',
            'avaliacao.min' => 'A avaliação deve conter no mínimo 10 caracteres.',
        ]);
    }


    public function store(Request $request)
    {
        $this->validateForm($request);

        Avaliacao::create($request->all());

        return redirect()->route('avaliacao.index')->with('success', 'Avaliação registrada com sucesso!');
    }

    public function edit(int $id)
    {
        $data = Avaliacao::with('livro')->findOrFail($id);
        $livros = Livraria::orderBy('nome')->get();
        return view('avaliacao.form', compact('data', 'livros'));
    }

  
    public function update(Request $request, int $id)
    {
        $this->validateForm($request);

        $avaliacao = Avaliacao::findOrFail($id);
        $avaliacao->update($request->all());

        return redirect()->route('avaliacao.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

  
    public function destroy(int $id)
    {
        Avaliacao::destroy($id);

        return redirect()->route('avaliacao.index')->with('success', 'Avaliação removida com sucesso!');
    }


    public function search(Request $request)
    {
        $tipo = $request->input('tipo', 'livro');
        $valor = $request->input('valor');

        $query = Avaliacao::with('livro');

        if (!empty($valor)) {
            if ($tipo === 'livro') {
                $query->whereHas('livro', function ($q) use ($valor) {
                    $q->where('nome', 'like', "%{$valor}%");
                });
            } else {
                $campo = in_array($tipo, ['autor', 'avaliacao']) ? $tipo : 'avaliacao';
                $query->where($campo, 'like', "%{$valor}%");
            }
        }

        $dados = $query->orderBy('id', 'desc')->get();

        return view('avaliacao.list', compact('dados'));
    }
}