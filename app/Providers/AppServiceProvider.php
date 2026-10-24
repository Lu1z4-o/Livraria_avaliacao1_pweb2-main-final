<?php
//O AppServiceProvider é o arquivo de configuração global do Laravel. Ele serve para carregar regras e ajustes gerais que precisam rodar em todo o sistema assim que a aplicação é iniciada.

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // Serve para registrar serviços no container do Laravel antes da aplicação rodar (geralmente usado para binding de interfaces)
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // Executado logo depois que todos os serviços foram registrados. É onde você coloca configurações globais (como paginador padrão, esquemas do banco ou regras globais de rotas)
    public function boot(): void
    {
        //
    }
}