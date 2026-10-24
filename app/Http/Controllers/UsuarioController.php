<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    
    public function index()
    {
        $dados = Usuario::orderBy('id', 'desc')->get(); 
        return view('usuario.list', compact('dados'));
    }

    public function create()
    {
        return view('usuario.form');
    }

   
    private function validateForm(Request $request, ?int $id = null)
    {
        $uniqueEmail = 'unique:usuarios,email' . ($id ? ",$id,id" : '');

        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:18',
            'endereco' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', $uniqueEmail],
            'telefone' => 'required|string|max:25',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ], [
            'nome.required' => 'O nome do usuário é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'endereco.required' => 'O endereço completo é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado para outro usuário.',
            'telefone.required' => 'O telefone de contato é obrigatório.',
            'foto.image' => 'O arquivo da foto de perfil deve ser uma imagem válida.',
            'foto.mimes' => 'A foto de perfil deve estar nos formatos: JPEG, PNG, JPG, WEBP ou GIF.',
            'foto.max' => 'A foto não pode ultrapassar 2MB.',
        ]);
    }

   
    public function store(Request $request)
    {
        $this->validateForm($request);

        $dados = $request->except(['foto']);

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $dados['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        Usuario::create($dados);

        return redirect()->route('usuario.index')->with('success', 'Usuário cadastrado com sucesso!');
    }


    public function edit(int $id)
    {
        $data = Usuario::findOrFail($id);
        return view('usuario.form', compact('data'));
    }

   
    public function update(Request $request, int $id)
    {
        $this->validateForm($request, $id);

        $usuario = Usuario::findOrFail($id);
        $dados = $request->except(['foto', 'remover_foto']);

        // usuário optou por remover a foto atual
        if ($request->has('remover_foto') && $usuario->foto) {
            if (Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $dados['foto'] = null;
        }

        //  substitui o arquivo antigo
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $dados['foto'] = $request->file('foto')->store('usuarios', 'public');
        }

        $usuario->update($dados);

        return redirect()->route('usuario.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $usuario->delete();
        }

        return redirect()->route('usuario.index')->with('success', 'Usuário e foto de perfil excluídos com sucesso!');
    }

    public function search(Request $request)
    {
        $tipo = $request->input('tipo', 'nome');
        $valor = $request->input('valor');

        if (!empty($valor)) {
            $campo = in_array($tipo, ['nome', 'cpf', 'email', 'telefone', 'endereco']) ? $tipo : 'nome';
            $dados = Usuario::where($campo, 'like', "%{$valor}%")->orderBy('id', 'desc')->get();
        } else {
            $dados = Usuario::orderBy('id', 'desc')->get();
        }

        return view('usuario.list', compact('dados'));
    }
}