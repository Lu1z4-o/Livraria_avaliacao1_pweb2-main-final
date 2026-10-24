<nav class="navbar navbar-expand-lg navbar-livraria py-2 py-lg-3">
    <div class="container">
        <a class="navbar-brand brand-font d-flex align-items-center gap-2" href="{{ url('/') }}">
            <i class="bi bi-book-half text-warning fs-3"></i>
            <span>Livraria Acácia</span>
        </a>

        <button class="navbar-toggler text-white border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Alternar navegação">
            <i class="bi bi-list fs-1"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('livraria*') ? 'active' : '' }}" href="{{ url('livraria') }}">
                        <i class="bi bi-journal-bookmark me-1"></i> Livros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('ebook*') ? 'active' : '' }}" href="{{ url('ebook') }}">
                        <i class="bi bi-tablet me-1"></i> E-books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('hashtag*') ? 'active' : '' }}" href="{{ url('hashtag') }}">
                        <i class="bi bi-hash me-1"></i> Hashtags
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('avaliacao*') ? 'active' : '' }}" href="{{ url('avaliacao') }}">
                        <i class="bi bi-star me-1"></i> Avaliações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('usuario*') ? 'active' : '' }}" href="{{ url('usuario') }}">
                        <i class="bi bi-people me-1"></i> Usuários
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('relatorios*') ? 'active' : '' }}" href="{{ route('relatorios.index') }}">
                        <i class="bi bi-pie-chart-fill me-1 text-warning"></i> Gráficos & PDFs
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
