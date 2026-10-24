-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: db_web_luiza_vitoria_banco
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avaliacaos`
--

DROP TABLE IF EXISTS `avaliacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacaos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `livro_id` bigint unsigned NOT NULL,
  `autor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `avaliacao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacaos_livro_id_foreign` (`livro_id`),
  CONSTRAINT `avaliacaos_livro_id_foreign` FOREIGN KEY (`livro_id`) REFERENCES `livraria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacaos`
--

LOCK TABLES `avaliacaos` WRITE;
/*!40000 ALTER TABLE `avaliacaos` DISABLE KEYS */;
INSERT INTO `avaliacaos` VALUES (1,1,'Clarice Lispector','2026-03-10','Uma das maiores obras da literatura mundial. O enigma em torno do olhar de Capitu e a psicologia do ciúme humano são insuperáveis.','2026-10-17 00:04:53','2026-10-17 00:04:53'),(2,1,'Antonio Candido','2026-04-15','Machado de Assis constrói uma narrativa onde a ambiguidade é a verdadeira protagonista. Leitura obrigatória.','2026-10-17 00:04:53','2026-10-17 00:04:53'),(3,2,'Roberto Schwarz','2026-02-20','O humor negro e a forma volúvel da narrativa machadiana capturam com precisão cirúrgica a elite da época.','2026-10-17 00:04:53','2026-10-17 00:04:53'),(4,3,'Augusto de Campos','2026-05-12','A personificação do cortiço como um organismo vivo e pulsante é um dos ápices da prosa naturalista em língua portuguesa.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(5,4,'Manuel Bandeira','2026-01-18','Poema em prosa que canta com lirismo incomparável as belezas e as dores da terra natal.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(6,5,'Lúcia Miguel Pereira','2026-06-05','Aurélia é uma das personagens femininas mais complexas e fascinantes de todo o Romantismo nacional.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(7,6,'Moacyr Scliar','2026-07-22','Uma genial advertência contra o dogmatismo e a arrogância dos que se creem donos absolutos da verdade científica.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(8,7,'Virginia Woolf','2026-03-30','Jane Austen possui a mais fina das sensibilidades cômicas aliada a uma profunda compreensão das convenções humanas.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(9,8,'Gabriel García Márquez','2026-08-11','Ler a primeira frase de A Metamorfose mudou minha vida para sempre: percebi que a literatura podia ir a lugares nunca antes imaginados.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(10,9,'Stephen King','2026-05-19','O verdadeiro monstro não é a criatura que chora por amor e compreensão, mas a arrogância cega do homem.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(11,10,'Boris Schnaiderman','2026-09-01','Uma joia lírica da juventude de Dostoiévski, onde a ternura convive intimamente com o destino amargo da solidão.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(12,11,'Harold Bloom','2026-02-14','Shakespeare inventou a linguagem moderna do amor romântico nesta obra-prima eterna.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(13,12,'Fernando Pessoa','2026-06-10','Canto maior da nossa língua. Os deuses do Olimpo curvam-se perante a audácia dos navegantes lusos.','2026-10-17 00:04:54','2026-10-17 00:04:54');
/*!40000 ALTER TABLE `avaliacaos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_livros`
--

DROP TABLE IF EXISTS `categoria_livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_livros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_livros`
--

LOCK TABLES `categoria_livros` WRITE;
/*!40000 ALTER TABLE `categoria_livros` DISABLE KEYS */;
INSERT INTO `categoria_livros` VALUES (1,'Realismo e Naturalismo','2026-10-17 00:04:52','2026-10-17 00:04:52'),(2,'Romantismo Clássico','2026-10-17 00:04:52','2026-10-17 00:04:52'),(3,'Clássicos Universais','2026-10-17 00:04:52','2026-10-17 00:04:52'),(4,'Ficção Científica e Terror Gótico','2026-10-17 00:04:52','2026-10-17 00:04:52'),(5,'Drama e Tragédia','2026-10-17 00:04:52','2026-10-17 00:04:52'),(6,'Sátira e Crítica Social','2026-10-17 00:04:52','2026-10-17 00:04:52');
/*!40000 ALTER TABLE `categoria_livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ebooks`
--

DROP TABLE IF EXISTS `ebooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebooks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `livro_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_de_paginas` int NOT NULL,
  `sinopse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanho_do_arquivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ebooks_livro_id_unique` (`livro_id`),
  CONSTRAINT `ebooks_livro_id_foreign` FOREIGN KEY (`livro_id`) REFERENCES `livraria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ebooks`
--

LOCK TABLES `ebooks` WRITE;
/*!40000 ALTER TABLE `ebooks` DISABLE KEYS */;
INSERT INTO `ebooks` VALUES (1,1,'Dom Casmurro','Machado de Assis','Livraria Garnier / Domínio Público',256,'Bento Santiago, apelidado de Dom Casmurro na velhice, narra em primeira pessoa suas memórias de infância e juventude no Rio de Janeiro, com foco obsessivo em seu amor por Capitu e nas dúvidas torturantes sobre uma suposta traição com seu melhor amigo, Escobar.','2.1 MB','2026-10-17 00:04:52','2026-10-17 00:04:52'),(2,2,'Memórias Póstumas de Brás Cubas','Machado de Assis','Tipografia Nacional / Domínio Público',208,'Um defunto autor decide narrar sua própria vida a partir do além-túmulo, dissecando com ironia demolidora as hipocrisias da sociedade aristocrática brasileira do século XIX. Obra fundadora do Realismo no Brasil.','1.8 MB','2026-10-17 00:04:53','2026-10-17 00:04:53'),(3,3,'O Cortiço','Aluísio Azevedo','B. L. Garnier / Domínio Público',304,'Retrato vívido da vida coletiva em uma habitação proletária no Rio de Janeiro do século XIX, explorando as tensões sociais, as paixões animalescas e a ascensão implacável do ambicioso taverneiro João Romão.','2.5 MB','2026-10-17 00:04:53','2026-10-17 00:04:53'),(4,4,'Iracema','José de Alencar','Tipografia Americana / Domínio Público',168,'A virgem dos lábios de mel e cabelos negros como a asa da graúna vive um amor trágico com o guerreiro branco Martim, constituindo o mito fundador poético do nascimento do povo cearense e brasileiro.','1.4 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(5,5,'Senhora','José de Alencar','Editora Garnier / Domínio Público',280,'Aurélia Camargo, ao receber uma fortuna inesperada, decide comprar o homem que outrora a abandonou por dote, propondo um casamento de conveniência que se transforma em uma tensa disputa psicológica de orgulho e redenção.','2.3 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(6,6,'O Alienista','Machado de Assis','Papelaria Americana / Domínio Público',112,'Na vila de Itaguaí, o respeitado médico Dr. Simão Bacamarte funda o hospício Casa Verde para estudar cientificamente a loucura, mas suas teorias o levam a encarcerar a esmagadora maioria dos cidadãos da cidade.','1.1 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(7,7,'Orgulho e Preconceito','Jane Austen','T. Egerton Publishing / Domínio Público',360,'Na Inglaterra rural do início do século XIX, a vivaz e inteligente Elizabeth Bennet aprende a rever seus julgamentos precipitados ao se deparar com o orgulhoso e aristocrático Sr. Darcy.','2.8 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(8,8,'A Metamorfose','Franz Kafka','Kurt Wolff Verlag / Domínio Público',96,'O caixeiro-viajante Gregor Samsa acorda transformado em um inseto monstruoso, expondo a alienação desumanizadora do trabalho, a frieza dos vínculos familiares e a angústia existencial moderna.','1.2 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(9,9,'Frankenstein','Mary Shelley','Lackington & Hughes / Domínio Público',280,'Victor Frankenstein anima uma criatura montada a partir de cadáveres e, aterrorizado com o resultado de sua ambição sem limites, abandona o ser à própria sorte, deflagrando uma espiral de vingança, rejeição e tragédia.','2.4 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(10,10,'Noites Brancas','Fiódor Dostoiévski','Anais da Pátria / Domínio Público',120,'Durante o fenômeno das noites claras de São Petersburgo, um solitário sonhador vaga pelas pontes da cidade e conhece Nástenka, vivendo com ela quatro noites de confidências, ternura e amor platônico.','1.3 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(11,11,'Romeu e Julieta','William Shakespeare','John Danter / Domínio Público',176,'Em Verona, o ódio secular entre as famílias Capuleto e Montecchio não impede o amor fulminante de dois jovens amantes, cujo destino trágico acaba por reconciliar seus parentes em luto perpétuo.','1.6 MB','2026-10-17 00:04:54','2026-10-17 00:04:54'),(12,12,'Os Lusíadas','Luís de Camões','Oficina de António Gonçalves / Domínio Público',384,'A epopeia magna da língua portuguesa em dez cantos e oitava rima, cantando a viagem marítima pioneira de Vasco da Gama rumo às Índias e celebrando os feitos heroicos da história de Portugal.','3.2 MB','2026-10-17 00:04:54','2026-10-17 00:04:54');
/*!40000 ALTER TABLE `ebooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hashtags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tropo Literário',
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `cor` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#8C5A3C',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hashtags_tag_unique` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hashtags`
--

LOCK TABLES `hashtags` WRITE;
/*!40000 ALTER TABLE `hashtags` DISABLE KEYS */;
INSERT INTO `hashtags` VALUES (1,'#classico-brasileiro','Origem / Patrimônio','Obras essenciais da formação da literatura brasileira.','#2a9d8f','2026-10-17 00:04:52','2026-10-17 00:04:52'),(2,'#realismo','Escola Literária','Fidelidade à realidade, análise psicológica e crítica de costumes.','#4a4e69','2026-10-17 00:04:52','2026-10-17 00:04:52'),(3,'#romantismo','Escola Literária','Exaltação dos sentimentos, idealização amorosa e nacionalismo.','#d90429','2026-10-17 00:04:52','2026-10-17 00:04:52'),(4,'#enemies-to-lovers','Tropo Literário','Rivalidade ou desprezo mútuo que se transforma em atração irresistível.','#ff006e','2026-10-17 00:04:52','2026-10-17 00:04:52'),(5,'#slow-burn','Tropo Literário','Desenvolvimento emocional gradual, cuidadoso e cheio de tensão.','#fb5607','2026-10-17 00:04:52','2026-10-17 00:04:52'),(6,'#narrador-nao-confiavel','Técnica Narrativa','Perspectiva enviesada onde o leitor deve duvidar das intenções do narrador.','#8338ec','2026-10-17 00:04:52','2026-10-17 00:04:52'),(7,'#ironia-social','Vibe / Estilo','Olhar sarcástico sobre a hipocrisia das convenções e classes abastadas.','#8c5a3c','2026-10-17 00:04:52','2026-10-17 00:04:52'),(8,'#naturalismo','Escola Literária','Visão biológica e determinista da sociedade e dos instintos humanos.','#264653','2026-10-17 00:04:52','2026-10-17 00:04:52'),(9,'#horror-gotico','Subgênero','Castelos sombrios, dilemas morais, terror atmosférico e segredos.','#1d3557','2026-10-17 00:04:52','2026-10-17 00:04:52'),(10,'#amor-proibido','Tropo Literário','Paixão impedida por rivalidades familiares, classes ou convenções.','#e63946','2026-10-17 00:04:52','2026-10-17 00:04:52'),(11,'#classico-universal','Cânone Mundial','Obras que ultrapassaram fronteiras e marcaram a humanidade.','#3a86ff','2026-10-17 00:04:52','2026-10-17 00:04:52'),(12,'#vinganca','Tropo Literário','Busca implacável por reparação e justiça contra antigos algozes.','#6a040f','2026-10-17 00:04:52','2026-10-17 00:04:52'),(13,'#existencialismo','Filosofia','Reflexão sobre a liberdade, a angústia e o sentido da existência.','#588157','2026-10-17 00:04:52','2026-10-17 00:04:52'),(14,'#solidao','Vibe / Clima','Ambientes melancólicos e personagens à procura de afeto.','#6d6875','2026-10-17 00:04:52','2026-10-17 00:04:52'),(15,'#defunto-autor','Técnica Narrativa','Ousadia de falar além da vida sem dever satisfações a ninguém.','#495057','2026-10-17 00:04:52','2026-10-17 00:04:52'),(16,'#ciumes','Dinâmica Psicológica','Obsessão destrutiva por supostas traições.','#b5179e','2026-10-17 00:04:52','2026-10-17 00:04:52'),(17,'#coletividade-urbana','Ambientação','Espaços populares onde a multidão atua como um só ser vivo.','#e76f51','2026-10-17 00:04:52','2026-10-17 00:04:52'),(18,'#mitologia-brasileira','Identidade','Lendas, paisagens tropicais e raízes indígenas míticas.','#52b788','2026-10-17 00:04:52','2026-10-17 00:04:52'),(19,'#satira-social','Gênero Crítico','Humor que desmascara as tolices da humanidade.','#f3722c','2026-10-17 00:04:52','2026-10-17 00:04:52'),(20,'#ficcao-cientifica','Subgênero','A ciência usada para desafiar limites cósmicos e biológicos.','#0077b6','2026-10-17 00:04:52','2026-10-17 00:04:52'),(21,'#criador-e-criatura','Arquétipo','A relação complexa entre quem gera e quem é gerado.','#023e8a','2026-10-17 00:04:52','2026-10-17 00:04:52'),(22,'#tragedia','Gênero Clássico','Caminhos inescapáveis que conduzem ao clímax doloroso e catártico.','#9d0208','2026-10-17 00:04:52','2026-10-17 00:04:52'),(23,'#star-crossed-lovers','Tropo Literário','Amantes cujas estrelas conspiram contra seu final feliz.','#f72585','2026-10-17 00:04:52','2026-10-17 00:04:52'),(24,'#epopeia','Gênero Clássico','Grandes viagens, guerras heroicas e celebrações civilizatórias.','#d4a373','2026-10-17 00:04:52','2026-10-17 00:04:52'),(25,'#camoes','Homenagem','A maestria poética máxima da língua de Camões.','#bc6c25','2026-10-17 00:04:52','2026-10-17 00:04:52'),(26,'#romance-de-epoca','Ambientação','Salões aristocráticos, cartas apaixonadas e bailes de gala.','#f15bb5','2026-10-17 00:04:52','2026-10-17 00:04:52'),(27,'#loucura-e-razao','Tema Central','A linha tênue que separa a sensatez do delírio.','#7209b7','2026-10-17 00:04:52','2026-10-17 00:04:52'),(28,'#alienacao','Tema Social','O indivíduo despojado de sua essência por sistemas opressores.','#343a40','2026-10-17 00:04:52','2026-10-17 00:04:52');
/*!40000 ALTER TABLE `hashtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livraria`
--

DROP TABLE IF EXISTS `livraria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livraria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` bigint unsigned NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinopse` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `livraria_nome_unique` (`nome`),
  KEY `livraria_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `livraria_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_livros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livraria`
--

LOCK TABLES `livraria` WRITE;
/*!40000 ALTER TABLE `livraria` DISABLE KEYS */;
INSERT INTO `livraria` VALUES (1,'Dom Casmurro','Machado de Assis',39.90,'Romance Psicológico',1,NULL,'Bento Santiago, apelidado de Dom Casmurro na velhice, narra em primeira pessoa suas memórias de infância e juventude no Rio de Janeiro, com foco obsessivo em seu amor por Capitu e nas dúvidas torturantes sobre uma suposta traição com seu melhor amigo, Escobar.','2026-10-17 00:04:52','2026-10-17 00:04:52'),(2,'Memórias Póstumas de Brás Cubas','Machado de Assis',34.50,'Sátira Realista',1,NULL,'Um defunto autor decide narrar sua própria vida a partir do além-túmulo, dissecando com ironia demolidora as hipocrisias da sociedade aristocrática brasileira do século XIX. Obra fundadora do Realismo no Brasil.','2026-10-17 00:04:53','2026-10-17 00:04:53'),(3,'O Cortiço','Aluísio Azevedo',29.90,'Naturalismo',1,NULL,'Retrato vívido da vida coletiva em uma habitação proletária no Rio de Janeiro do século XIX, explorando as tensões sociais, as paixões animalescas e a ascensão implacável do ambicioso taverneiro João Romão.','2026-10-17 00:04:53','2026-10-17 00:04:53'),(4,'Iracema','José de Alencar',24.90,'Romance Indianista',2,NULL,'A virgem dos lábios de mel e cabelos negros como a asa da graúna vive um amor trágico com o guerreiro branco Martim, constituindo o mito fundador poético do nascimento do povo cearense e brasileiro.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(5,'Senhora','José de Alencar',32.00,'Romance de Costumes',2,NULL,'Aurélia Camargo, ao receber uma fortuna inesperada, decide comprar o homem que outrora a abandonou por dote, propondo um casamento de conveniência que se transforma em uma tensa disputa psicológica de orgulho e redenção.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(6,'O Alienista','Machado de Assis',22.00,'Novela Satírica',6,NULL,'Na vila de Itaguaí, o respeitado médico Dr. Simão Bacamarte funda o hospício Casa Verde para estudar cientificamente a loucura, mas suas teorias o levam a encarcerar a esmagadora maioria dos cidadãos da cidade.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(7,'Orgulho e Preconceito','Jane Austen',45.00,'Romance de Época',3,NULL,'Na Inglaterra rural do início do século XIX, a vivaz e inteligente Elizabeth Bennet aprende a rever seus julgamentos precipitados ao se deparar com o orgulhoso e aristocrático Sr. Darcy.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(8,'A Metamorfose','Franz Kafka',25.00,'Ficção Existencialista',3,NULL,'O caixeiro-viajante Gregor Samsa acorda transformado em um inseto monstruoso, expondo a alienação desumanizadora do trabalho, a frieza dos vínculos familiares e a angústia existencial moderna.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(9,'Frankenstein','Mary Shelley',38.00,'Ficção Científica e Horror',4,NULL,'Victor Frankenstein anima uma criatura montada a partir de cadáveres e, aterrorizado com o resultado de sua ambição sem limites, abandona o ser à própria sorte, deflagrando uma espiral de vingança, rejeição e tragédia.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(10,'Noites Brancas','Fiódor Dostoiévski',27.50,'Romance Sentimental',2,NULL,'Durante o fenômeno das noites claras de São Petersburgo, um solitário sonhador vaga pelas pontes da cidade e conhece Nástenka, vivendo com ela quatro noites de confidências, ternura e amor platônico.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(11,'Romeu e Julieta','William Shakespeare',31.90,'Tragédia Clássica',5,NULL,'Em Verona, o ódio secular entre as famílias Capuleto e Montecchio não impede o amor fulminante de dois jovens amantes, cujo destino trágico acaba por reconciliar seus parentes em luto perpétuo.','2026-10-17 00:04:54','2026-10-17 00:04:54'),(12,'Os Lusíadas','Luís de Camões',42.00,'Epopeia Clássica',5,NULL,'A epopeia magna da língua portuguesa em dez cantos e oitava rima, cantando a viagem marítima pioneira de Vasco da Gama rumo às Índias e celebrando os feitos heroicos da história de Portugal.','2026-10-17 00:04:54','2026-10-17 00:04:54');
/*!40000 ALTER TABLE `livraria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_hashtag`
--

DROP TABLE IF EXISTS `livro_hashtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livro_hashtag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `livro_id` bigint unsigned NOT NULL,
  `hashtag_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `livro_hashtag_livro_id_hashtag_id_unique` (`livro_id`,`hashtag_id`),
  KEY `livro_hashtag_hashtag_id_foreign` (`hashtag_id`),
  CONSTRAINT `livro_hashtag_hashtag_id_foreign` FOREIGN KEY (`hashtag_id`) REFERENCES `hashtags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `livro_hashtag_livro_id_foreign` FOREIGN KEY (`livro_id`) REFERENCES `livraria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_hashtag`
--

LOCK TABLES `livro_hashtag` WRITE;
/*!40000 ALTER TABLE `livro_hashtag` DISABLE KEYS */;
INSERT INTO `livro_hashtag` VALUES (1,1,6,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(2,1,16,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(3,1,2,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(4,1,1,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(5,2,15,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(6,2,7,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(7,2,2,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(8,2,1,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(9,3,8,'2026-10-17 00:04:53','2026-10-17 00:04:53'),(10,3,17,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(11,3,1,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(12,4,3,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(13,4,18,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(14,4,10,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(15,4,1,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(16,5,4,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(17,5,3,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(18,5,12,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(19,5,5,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(20,6,19,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(21,6,7,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(22,6,27,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(23,6,1,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(24,7,4,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(25,7,5,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(26,7,26,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(27,7,7,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(28,8,13,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(29,8,28,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(30,8,11,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(31,9,9,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(32,9,20,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(33,9,21,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(34,9,12,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(35,10,14,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(36,10,11,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(37,10,5,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(38,11,10,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(39,11,22,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(40,11,11,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(41,11,23,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(42,12,24,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(43,12,11,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(44,12,18,'2026-10-17 00:04:54','2026-10-17 00:04:54'),(45,12,25,'2026-10-17 00:04:54','2026-10-17 00:04:54');
/*!40000 ALTER TABLE `livro_hashtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_01_000000_create_usuarios_table',1),(5,'2026_06_02_131044_create_categoria_livros_table',1),(6,'2026_08_28_005233_create_livraria_table',1),(7,'2026_09_02_143537_create_avaliacaos_table',1),(8,'2026_10_13_000233_create_hashtags_table',1),(9,'2026_10_13_004426_add_imagem_to_livraria_table',1),(10,'2026_10_13_011219_create_livro_hashtag_table',1),(11,'2026_10_16_160000_create_ebooks_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('P9RFCv1Vwk6sFugxYjUZcSwfLmGg4yxKDioZB5rP',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJKNlBmUnBQODJLWW1NWjJreUhCNngxSGRseGNUUWl6bDE5QjJIME5PIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1792500764),('x0HUc0JYmmrZWUhUNEUyPHhVXWQaTxWpRjzW2czB',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJsbUZvbzJBd3B6RWRWZEoxbkxFcWo2S0VWaUU5Y3dQak5IOWFhSmphIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1792184965);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Luíza Vitória Silveira','123.456.789-01','Av. Mauro Ramos, 1200 - Centro, Florianópolis/SC','luiza.vitoria@aluno.ifsc.edu.br','(48) 98877-6655',NULL,'2026-10-17 00:04:55','2026-10-17 00:04:55'),(2,'Prof. Gabriel Schuler','987.654.321-09','Rua Santos Saraiva, 450 - Estreito, Florianópolis/SC','gabriel.schuler@ifsc.edu.br','(48) 99123-4567',NULL,'2026-10-17 00:04:55','2026-10-17 00:04:55'),(3,'Machado de Assis Leitor','111.222.333-44','Rua do Ouvidor, 55 - Centro Histórico, Rio de Janeiro/RJ','machado.leitor@dominio.publico.br','(21) 97788-9900',NULL,'2026-10-17 00:04:55','2026-10-17 00:04:55'),(4,'Ana Beatriz Vasconcelos','555.666.777-88','Rua Bocaiúva, 80 - Florianópolis/SC','ana.vasconcelos@biblioteca.org','(48) 98456-7890',NULL,'2026-10-17 00:04:55','2026-10-17 00:04:55');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-20  9:54:02
