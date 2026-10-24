<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaLivro;
use App\Models\Livraria;
use App\Models\Ebook;
use App\Models\Hashtag;
use App\Models\Avaliacao;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categorias Literárias
        $categoriasData = [
            'Realismo e Naturalismo',
            'Romantismo Clássico',
            'Clássicos Universais',
            'Ficção Científica e Terror Gótico',
            'Drama e Tragédia',
            'Sátira e Crítica Social',
        ];

        $categorias = [];
        foreach ($categoriasData as $nomeCat) {
            $categorias[$nomeCat] = CategoriaLivro::firstOrCreate(['categoria' => $nomeCat]);
        }

        // 2. Acervo de Obras Estritamente em Domínio Público (Conforme solicitado)
        // Todos os livros em domínio público para isenção de registro comercial de obras digitais
        $livrosDominioPublico = [
            [
                'nome' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'valor' => 39.90,
                'genero' => 'Romance Psicológico',
                'categoria' => 'Realismo e Naturalismo',
                'sinopse' => 'Bento Santiago, apelidado de Dom Casmurro na velhice, narra em primeira pessoa suas memórias de infância e juventude no Rio de Janeiro, com foco obsessivo em seu amor por Capitu e nas dúvidas torturantes sobre uma suposta traição com seu melhor amigo, Escobar.',
                'ebook' => [
                    'editora' => 'Livraria Garnier / Domínio Público',
                    'numero_de_paginas' => 256,
                    'tamanho_do_arquivo' => '2.1 MB',
                ],
                'tags' => ['#narrador-nao-confiavel', '#ciumes', '#realismo', '#classico-brasileiro'],
                'avaliacoes' => [
                    [
                        'autor' => 'Clarice Lispector',
                        'data' => '2026-03-10',
                        'avaliacao' => 'Uma das maiores obras da literatura mundial. O enigma em torno do olhar de Capitu e a psicologia do ciúme humano são insuperáveis.',
                    ],
                    [
                        'autor' => 'Antonio Candido',
                        'data' => '2026-04-15',
                        'avaliacao' => 'Machado de Assis constrói uma narrativa onde a ambiguidade é a verdadeira protagonista. Leitura obrigatória.',
                    ]
                ]
            ],
            [
                'nome' => 'Memórias Póstumas de Brás Cubas',
                'autor' => 'Machado de Assis',
                'valor' => 34.50,
                'genero' => 'Sátira Realista',
                'categoria' => 'Realismo e Naturalismo',
                'sinopse' => 'Um defunto autor decide narrar sua própria vida a partir do além-túmulo, dissecando com ironia demolidora as hipocrisias da sociedade aristocrática brasileira do século XIX. Obra fundadora do Realismo no Brasil.',
                'ebook' => [
                    'editora' => 'Tipografia Nacional / Domínio Público',
                    'numero_de_paginas' => 208,
                    'tamanho_do_arquivo' => '1.8 MB',
                ],
                'tags' => ['#defunto-autor', '#ironia-social', '#realismo', '#classico-brasileiro'],
                'avaliacoes' => [
                    [
                        'autor' => 'Roberto Schwarz',
                        'data' => '2026-02-20',
                        'avaliacao' => 'O humor negro e a forma volúvel da narrativa machadiana capturam com precisão cirúrgica a elite da época.',
                    ]
                ]
            ],
            [
                'nome' => 'O Cortiço',
                'autor' => 'Aluísio Azevedo',
                'valor' => 29.90,
                'genero' => 'Naturalismo',
                'categoria' => 'Realismo e Naturalismo',
                'sinopse' => 'Retrato vívido da vida coletiva em uma habitação proletária no Rio de Janeiro do século XIX, explorando as tensões sociais, as paixões animalescas e a ascensão implacável do ambicioso taverneiro João Romão.',
                'ebook' => [
                    'editora' => 'B. L. Garnier / Domínio Público',
                    'numero_de_paginas' => 304,
                    'tamanho_do_arquivo' => '2.5 MB',
                ],
                'tags' => ['#naturalismo', '#critica-social', '#coletividade-urbana', '#classico-brasileiro'],
                'avaliacoes' => [
                    [
                        'autor' => 'Augusto de Campos',
                        'data' => '2026-05-12',
                        'avaliacao' => 'A personificação do cortiço como um organismo vivo e pulsante é um dos ápices da prosa naturalista em língua portuguesa.',
                    ]
                ]
            ],
            [
                'nome' => 'Iracema',
                'autor' => 'José de Alencar',
                'valor' => 24.90,
                'genero' => 'Romance Indianista',
                'categoria' => 'Romantismo Clássico',
                'sinopse' => 'A virgem dos lábios de mel e cabelos negros como a asa da graúna vive um amor trágico com o guerreiro branco Martim, constituindo o mito fundador poético do nascimento do povo cearense e brasileiro.',
                'ebook' => [
                    'editora' => 'Tipografia Americana / Domínio Público',
                    'numero_de_paginas' => 168,
                    'tamanho_do_arquivo' => '1.4 MB',
                ],
                'tags' => ['#romantismo', '#mitologia-brasileira', '#amor-proibido', '#classico-brasileiro'],
                'avaliacoes' => [
                    [
                        'autor' => 'Manuel Bandeira',
                        'data' => '2026-01-18',
                        'avaliacao' => 'Poema em prosa que canta com lirismo incomparável as belezas e as dores da terra natal.',
                    ]
                ]
            ],
            [
                'nome' => 'Senhora',
                'autor' => 'José de Alencar',
                'valor' => 32.00,
                'genero' => 'Romance de Costumes',
                'categoria' => 'Romantismo Clássico',
                'sinopse' => 'Aurélia Camargo, ao receber uma fortuna inesperada, decide comprar o homem que outrora a abandonou por dote, propondo um casamento de conveniência que se transforma em uma tensa disputa psicológica de orgulho e redenção.',
                'ebook' => [
                    'editora' => 'Editora Garnier / Domínio Público',
                    'numero_de_paginas' => 280,
                    'tamanho_do_arquivo' => '2.3 MB',
                ],
                'tags' => ['#enemies-to-lovers', '#romantismo', '#vinganca', '#slow-burn'],
                'avaliacoes' => [
                    [
                        'autor' => 'Lúcia Miguel Pereira',
                        'data' => '2026-06-05',
                        'avaliacao' => 'Aurélia é uma das personagens femininas mais complexas e fascinantes de todo o Romantismo nacional.',
                    ]
                ]
            ],
            [
                'nome' => 'O Alienista',
                'autor' => 'Machado de Assis',
                'valor' => 22.00,
                'genero' => 'Novela Satírica',
                'categoria' => 'Sátira e Crítica Social',
                'sinopse' => 'Na vila de Itaguaí, o respeitado médico Dr. Simão Bacamarte funda o hospício Casa Verde para estudar cientificamente a loucura, mas suas teorias o levam a encarcerar a esmagadora maioria dos cidadãos da cidade.',
                'ebook' => [
                    'editora' => 'Papelaria Americana / Domínio Público',
                    'numero_de_paginas' => 112,
                    'tamanho_do_arquivo' => '1.1 MB',
                ],
                'tags' => ['#satira-social', '#ironia-social', '#loucura-e-razao', '#classico-brasileiro'],
                'avaliacoes' => [
                    [
                        'autor' => 'Moacyr Scliar',
                        'data' => '2026-07-22',
                        'avaliacao' => 'Uma genial advertência contra o dogmatismo e a arrogância dos que se creem donos absolutos da verdade científica.',
                    ]
                ]
            ],
            [
                'nome' => 'Orgulho e Preconceito',
                'autor' => 'Jane Austen',
                'valor' => 45.00,
                'genero' => 'Romance de Época',
                'categoria' => 'Clássicos Universais',
                'sinopse' => 'Na Inglaterra rural do início do século XIX, a vivaz e inteligente Elizabeth Bennet aprende a rever seus julgamentos precipitados ao se deparar com o orgulhoso e aristocrático Sr. Darcy.',
                'ebook' => [
                    'editora' => 'T. Egerton Publishing / Domínio Público',
                    'numero_de_paginas' => 360,
                    'tamanho_do_arquivo' => '2.8 MB',
                ],
                'tags' => ['#enemies-to-lovers', '#slow-burn', '#romance-de-epoca', '#ironia-social'],
                'avaliacoes' => [
                    [
                        'autor' => 'Virginia Woolf',
                        'data' => '2026-03-30',
                        'avaliacao' => 'Jane Austen possui a mais fina das sensibilidades cômicas aliada a uma profunda compreensão das convenções humanas.',
                    ]
                ]
            ],
            [
                'nome' => 'A Metamorfose',
                'autor' => 'Franz Kafka',
                'valor' => 25.00,
                'genero' => 'Ficção Existencialista',
                'categoria' => 'Clássicos Universais',
                'sinopse' => 'O caixeiro-viajante Gregor Samsa acorda transformado em um inseto monstruoso, expondo a alienação desumanizadora do trabalho, a frieza dos vínculos familiares e a angústia existencial moderna.',
                'ebook' => [
                    'editora' => 'Kurt Wolff Verlag / Domínio Público',
                    'numero_de_paginas' => 96,
                    'tamanho_do_arquivo' => '1.2 MB',
                ],
                'tags' => ['#existencialismo', '#alienacao', '#classico-universal', '#critica-social'],
                'avaliacoes' => [
                    [
                        'autor' => 'Gabriel García Márquez',
                        'data' => '2026-08-11',
                        'avaliacao' => 'Ler a primeira frase de A Metamorfose mudou minha vida para sempre: percebi que a literatura podia ir a lugares nunca antes imaginados.',
                    ]
                ]
            ],
            [
                'nome' => 'Frankenstein',
                'autor' => 'Mary Shelley',
                'valor' => 38.00,
                'genero' => 'Ficção Científica e Horror',
                'categoria' => 'Ficção Científica e Terror Gótico',
                'sinopse' => 'Victor Frankenstein anima uma criatura montada a partir de cadáveres e, aterrorizado com o resultado de sua ambição sem limites, abandona o ser à própria sorte, deflagrando uma espiral de vingança, rejeição e tragédia.',
                'ebook' => [
                    'editora' => 'Lackington & Hughes / Domínio Público',
                    'numero_de_paginas' => 280,
                    'tamanho_do_arquivo' => '2.4 MB',
                ],
                'tags' => ['#horror-gotico', '#ficcao-cientifica', '#criador-e-criatura', '#vinganca'],
                'avaliacoes' => [
                    [
                        'autor' => 'Stephen King',
                        'data' => '2026-05-19',
                        'avaliacao' => 'O verdadeiro monstro não é a criatura que chora por amor e compreensão, mas a arrogância cega do homem.',
                    ]
                ]
            ],
            [
                'nome' => 'Noites Brancas',
                'autor' => 'Fiódor Dostoiévski',
                'valor' => 27.50,
                'genero' => 'Romance Sentimental',
                'categoria' => 'Romantismo Clássico',
                'sinopse' => 'Durante o fenômeno das noites claras de São Petersburgo, um solitário sonhador vaga pelas pontes da cidade e conhece Nástenka, vivendo com ela quatro noites de confidências, ternura e amor platônico.',
                'ebook' => [
                    'editora' => 'Anais da Pátria / Domínio Público',
                    'numero_de_paginas' => 120,
                    'tamanho_do_arquivo' => '1.3 MB',
                ],
                'tags' => ['#romance-sentimental', '#solidao', '#classico-universal', '#slow-burn'],
                'avaliacoes' => [
                    [
                        'autor' => 'Boris Schnaiderman',
                        'data' => '2026-09-01',
                        'avaliacao' => 'Uma joia lírica da juventude de Dostoiévski, onde a ternura convive intimamente com o destino amargo da solidão.',
                    ]
                ]
            ],
            [
                'nome' => 'Romeu e Julieta',
                'autor' => 'William Shakespeare',
                'valor' => 31.90,
                'genero' => 'Tragédia Clássica',
                'categoria' => 'Drama e Tragédia',
                'sinopse' => 'Em Verona, o ódio secular entre as famílias Capuleto e Montecchio não impede o amor fulminante de dois jovens amantes, cujo destino trágico acaba por reconciliar seus parentes em luto perpétuo.',
                'ebook' => [
                    'editora' => 'John Danter / Domínio Público',
                    'numero_de_paginas' => 176,
                    'tamanho_do_arquivo' => '1.6 MB',
                ],
                'tags' => ['#amor-proibido', '#tragedia', '#classico-universal', '#star-crossed-lovers'],
                'avaliacoes' => [
                    [
                        'autor' => 'Harold Bloom',
                        'data' => '2026-02-14',
                        'avaliacao' => 'Shakespeare inventou a linguagem moderna do amor romântico nesta obra-prima eterna.',
                    ]
                ]
            ],
            [
                'nome' => 'Os Lusíadas',
                'autor' => 'Luís de Camões',
                'valor' => 42.00,
                'genero' => 'Epopeia Clássica',
                'categoria' => 'Drama e Tragédia',
                'sinopse' => 'A epopeia magna da língua portuguesa em dez cantos e oitava rima, cantando a viagem marítima pioneira de Vasco da Gama rumo às Índias e celebrando os feitos heroicos da história de Portugal.',
                'ebook' => [
                    'editora' => 'Oficina de António Gonçalves / Domínio Público',
                    'numero_de_paginas' => 384,
                    'tamanho_do_arquivo' => '3.2 MB',
                ],
                'tags' => ['#epopeia', '#classico-universal', '#mitologia-brasileira', '#camoes'],
                'avaliacoes' => [
                    [
                        'autor' => 'Fernando Pessoa',
                        'data' => '2026-06-10',
                        'avaliacao' => 'Canto maior da nossa língua. Os deuses do Olimpo curvam-se perante a audácia dos navegantes lusos.',
                    ]
                ]
            ]
        ];

        // 3. Cadastrar as Hashtags no Banco (Tabela hashtags independente)
        $todasTags = [
            '#classico-brasileiro' => ['tipo' => 'Origem / Patrimônio', 'descricao' => 'Obras essenciais da formação da literatura brasileira.', 'cor' => '#2a9d8f'],
            '#realismo' => ['tipo' => 'Escola Literária', 'descricao' => 'Fidelidade à realidade, análise psicológica e crítica de costumes.', 'cor' => '#4a4e69'],
            '#romantismo' => ['tipo' => 'Escola Literária', 'descricao' => 'Exaltação dos sentimentos, idealização amorosa e nacionalismo.', 'cor' => '#d90429'],
            '#enemies-to-lovers' => ['tipo' => 'Tropo Literário', 'descricao' => 'Rivalidade ou desprezo mútuo que se transforma em atração irresistível.', 'cor' => '#ff006e'],
            '#slow-burn' => ['tipo' => 'Tropo Literário', 'descricao' => 'Desenvolvimento emocional gradual, cuidadoso e cheio de tensão.', 'cor' => '#fb5607'],
            '#narrador-nao-confiavel' => ['tipo' => 'Técnica Narrativa', 'descricao' => 'Perspectiva enviesada onde o leitor deve duvidar das intenções do narrador.', 'cor' => '#8338ec'],
            '#ironia-social' => ['tipo' => 'Vibe / Estilo', 'descricao' => 'Olhar sarcástico sobre a hipocrisia das convenções e classes abastadas.', 'cor' => '#8c5a3c'],
            '#naturalismo' => ['tipo' => 'Escola Literária', 'descricao' => 'Visão biológica e determinista da sociedade e dos instintos humanos.', 'cor' => '#264653'],
            '#horror-gotico' => ['tipo' => 'Subgênero', 'descricao' => 'Castelos sombrios, dilemas morais, terror atmosférico e segredos.', 'cor' => '#1d3557'],
            '#amor-proibido' => ['tipo' => 'Tropo Literário', 'descricao' => 'Paixão impedida por rivalidades familiares, classes ou convenções.', 'cor' => '#e63946'],
            '#classico-universal' => ['tipo' => 'Cânone Mundial', 'descricao' => 'Obras que ultrapassaram fronteiras e marcaram a humanidade.', 'cor' => '#3a86ff'],
            '#vinganca' => ['tipo' => 'Tropo Literário', 'descricao' => 'Busca implacável por reparação e justiça contra antigos algozes.', 'cor' => '#6a040f'],
            '#existencialismo' => ['tipo' => 'Filosofia', 'descricao' => 'Reflexão sobre a liberdade, a angústia e o sentido da existência.', 'cor' => '#588157'],
            '#solidao' => ['tipo' => 'Vibe / Clima', 'descricao' => 'Ambientes melancólicos e personagens à procura de afeto.', 'cor' => '#6d6875'],
            '#defunto-autor' => ['tipo' => 'Técnica Narrativa', 'descricao' => 'Ousadia de falar além da vida sem dever satisfações a ninguém.', 'cor' => '#495057'],
            '#ciumes' => ['tipo' => 'Dinâmica Psicológica', 'descricao' => 'Obsessão destrutiva por supostas traições.', 'cor' => '#b5179e'],
            '#coletividade-urbana' => ['tipo' => 'Ambientação', 'descricao' => 'Espaços populares onde a multidão atua como um só ser vivo.', 'cor' => '#e76f51'],
            '#mitologia-brasileira' => ['tipo' => 'Identidade', 'descricao' => 'Lendas, paisagens tropicais e raízes indígenas míticas.', 'cor' => '#52b788'],
            '#satira-social' => ['tipo' => 'Gênero Crítico', 'descricao' => 'Humor que desmascara as tolices da humanidade.', 'cor' => '#f3722c'],
            '#ficcao-cientifica' => ['tipo' => 'Subgênero', 'descricao' => 'A ciência usada para desafiar limites cósmicos e biológicos.', 'cor' => '#0077b6'],
            '#criador-e-criatura' => ['tipo' => 'Arquétipo', 'descricao' => 'A relação complexa entre quem gera e quem é gerado.', 'cor' => '#023e8a'],
            '#tragedia' => ['tipo' => 'Gênero Clássico', 'descricao' => 'Caminhos inescapáveis que conduzem ao clímax doloroso e catártico.', 'cor' => '#9d0208'],
            '#star-crossed-lovers' => ['tipo' => 'Tropo Literário', 'descricao' => 'Amantes cujas estrelas conspiram contra seu final feliz.', 'cor' => '#f72585'],
            '#epopeia' => ['tipo' => 'Gênero Clássico', 'descricao' => 'Grandes viagens, guerras heroicas e celebrações civilizatórias.', 'cor' => '#d4a373'],
            '#camoes' => ['tipo' => 'Homenagem', 'descricao' => 'A maestria poética máxima da língua de Camões.', 'cor' => '#bc6c25'],
            '#romance-de-epoca' => ['tipo' => 'Ambientação', 'descricao' => 'Salões aristocráticos, cartas apaixonadas e bailes de gala.', 'cor' => '#f15bb5'],
            '#loucura-e-razao' => ['tipo' => 'Tema Central', 'descricao' => 'A linha tênue que separa a sensatez do delírio.', 'cor' => '#7209b7'],
            '#alienacao' => ['tipo' => 'Tema Social', 'descricao' => 'O indivíduo despojado de sua essência por sistemas opressores.', 'cor' => '#343a40'],
        ];

        $hashtagsSalvas = [];
        foreach ($todasTags as $tagStr => $info) {
            $hashtagsSalvas[$tagStr] = Hashtag::firstOrCreate(
                ['tag' => $tagStr],
                [
                    'tipo' => $info['tipo'],
                    'descricao' => $info['descricao'],
                    'cor' => $info['cor'],
                ]
            );
        }

        // 4. Inserção dos Livros, Ebooks (1:1), Hashtags (N:N) e Avaliações (1:N)
        foreach ($livrosDominioPublico as $livroInfo) {
            // Evitar duplicações pelo título (nome)
            $cat = $categorias[$livroInfo['categoria']];
            
            $livro = Livraria::firstOrCreate(
                ['nome' => $livroInfo['nome']],
                [
                    'autor' => $livroInfo['autor'],
                    'valor' => $livroInfo['valor'],
                    'genero' => $livroInfo['genero'],
                    'categoria_id' => $cat->id,
                    'sinopse' => $livroInfo['sinopse'],
                    'imagem' => null, // pronto para upload ou capa
                ]
            );

            // Relacionamento 1:1 - E-book de Domínio Público
            Ebook::updateOrCreate(
                ['livro_id' => $livro->id],
                [
                    'titulo' => $livro->nome,
                    'autor' => $livro->autor,
                    'editora' => $livroInfo['ebook']['editora'],
                    'numero_de_paginas' => $livroInfo['ebook']['numero_de_paginas'],
                    'sinopse' => $livro->sinopse,
                    'tamanho_do_arquivo' => $livroInfo['ebook']['tamanho_do_arquivo'],
                ]
            );

            // Relacionamento N:N - Hashtags associadas ao Livro
            $tagsIds = [];
            foreach ($livroInfo['tags'] as $tagStr) {
                if (isset($hashtagsSalvas[$tagStr])) {
                    $tagsIds[] = $hashtagsSalvas[$tagStr]->id;
                }
            }
            if (!empty($tagsIds)) {
                $livro->hashtags()->syncWithoutDetaching($tagsIds);
            }

            // Relacionamento 1:N - Avaliações vinculadas ao Livro
            if (!empty($livroInfo['avaliacoes'])) {
                foreach ($livroInfo['avaliacoes'] as $av) {
                    Avaliacao::firstOrCreate(
                        [
                            'livro_id' => $livro->id,
                            'autor' => $av['autor'],
                        ],
                        [
                            'data' => $av['data'],
                            'avaliacao' => $av['avaliacao'],
                        ]
                    );
                }
            }
        }

        // 5. Cadastrar Usuários de Exemplo com diferentes perfis
        $usuariosExemplo = [
            [
                'nome' => 'Luíza Vitória Silveira',
                'cpf' => '123.456.789-01',
                'endereco' => 'Av. Mauro Ramos, 1200 - Centro, Florianópolis/SC',
                'email' => 'luiza.vitoria@aluno.ifsc.edu.br',
                'telefone' => '(48) 98877-6655',
                'foto' => null,
            ],
            [
                'nome' => 'Prof. Gabriel Schuler',
                'cpf' => '987.654.321-09',
                'endereco' => 'Rua Santos Saraiva, 450 - Estreito, Florianópolis/SC',
                'email' => 'gabriel.schuler@ifsc.edu.br',
                'telefone' => '(48) 99123-4567',
                'foto' => null,
            ],
            [
                'nome' => 'Machado de Assis Leitor',
                'cpf' => '111.222.333-44',
                'endereco' => 'Rua do Ouvidor, 55 - Centro Histórico, Rio de Janeiro/RJ',
                'email' => 'machado.leitor@dominio.publico.br',
                'telefone' => '(21) 97788-9900',
                'foto' => null,
            ],
            [
                'nome' => 'Ana Beatriz Vasconcelos',
                'cpf' => '555.666.777-88',
                'endereco' => 'Rua Bocaiúva, 80 - Florianópolis/SC',
                'email' => 'ana.vasconcelos@biblioteca.org',
                'telefone' => '(48) 98456-7890',
                'foto' => null,
            ]
        ];

        foreach ($usuariosExemplo as $u) {
            Usuario::firstOrCreate(['email' => $u['email']], $u);
        }
    }
}
