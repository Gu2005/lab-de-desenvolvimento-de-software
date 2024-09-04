-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 04/09/2024 às 14:32
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_universidade`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cobrancas`
--

CREATE TABLE `cobrancas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_cobranca` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pendente','pago') DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `creditos`) VALUES
(1, 'Engenharia de Software', 240),
(2, 'Ciência da Computação', 240);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `tipo` enum('obrigatória','optativa') NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `nome`, `creditos`, `curso_id`, `professor_id`, `tipo`, `valor`, `periodo`) VALUES
(27, 'Cálculo Diferencial e Integral I', 4, 1, 43, 'obrigatória', 800.00, 1),
(28, 'Fundamentos de Programação', 4, 1, 29, 'obrigatória', 800.00, 1),
(29, 'Introdução à Engenharia de Software', 4, 1, 43, 'obrigatória', 800.00, 1),
(30, 'Lógica Matemática', 3, 1, 29, 'optativa', 600.00, 1),
(31, 'Álgebra Linear', 3, 1, 27, 'optativa', 600.00, 1),
(32, 'Comunicação e Expressão', 2, 1, 29, 'optativa', 400.00, 1),
(33, 'Cálculo Diferencial e Integral II', 4, 1, 31, 'obrigatória', 800.00, 2),
(34, 'Estruturas de Dados', 4, 1, 31, 'optativa', 800.00, 2),
(35, 'Engenharia de Requisitos', 4, 1, 32, 'obrigatória', 800.00, 2),
(36, 'Probabilidade e Estatística', 3, 1, NULL, 'optativa', 600.00, 2),
(37, 'Matemática Discreta', 3, 1, NULL, 'optativa', 600.00, 2),
(38, 'Fundamentos de Banco de Dados', 3, 1, NULL, 'obrigatória', 600.00, 2),
(39, 'Programação Orientada a Objetos', 4, 1, NULL, 'obrigatória', 800.00, 3),
(40, 'Engenharia de Software I', 4, 1, NULL, 'optativa', 800.00, 3),
(41, 'Sistemas Operacionais', 4, 1, NULL, 'obrigatória', 800.00, 3),
(42, 'Algoritmos Avançados', 4, 1, NULL, 'obrigatória', 800.00, 3),
(43, 'Banco de Dados II', 3, 1, NULL, 'obrigatória', 600.00, 3),
(44, 'Gestão de Projetos de Software', 3, 1, NULL, 'obrigatória', 600.00, 3),
(45, 'Cálculo Diferencial e Integral I', 4, 2, NULL, 'optativa', 800.00, 1),
(46, 'Fundamentos de Programação', 4, 2, NULL, 'obrigatória', 800.00, 1),
(47, 'Lógica para Computação', 4, 2, NULL, 'obrigatória', 800.00, 1),
(48, 'Álgebra Linear', 3, 2, NULL, 'optativa', 600.00, 1),
(49, 'Introdução à Ciência da Computação', 3, 2, NULL, 'obrigatória', 600.00, 1),
(50, 'Comunicação e Expressão', 2, 2, NULL, 'optativa', 400.00, 1),
(51, 'Cálculo Diferencial e Integral II', 4, 2, NULL, 'obrigatória', 800.00, 2),
(52, 'Estruturas de Dados', 4, 2, NULL, 'obrigatória', 800.00, 2),
(53, 'Arquitetura de Computadores', 4, 2, NULL, 'obrigatória', 800.00, 2),
(54, 'Matemática Discreta', 3, 2, NULL, 'optativa', 600.00, 2),
(55, 'Probabilidade e Estatística', 3, 2, NULL, 'optativa', 600.00, 2),
(56, 'Teoria dos Grafos', 3, 2, NULL, 'optativa', 600.00, 2),
(57, 'Programação Orientada a Objetos', 4, 2, NULL, 'obrigatória', 800.00, 3),
(58, 'Algoritmos Avançados', 4, 2, NULL, 'obrigatória', 800.00, 3),
(59, 'Sistemas Operacionais', 4, 2, NULL, 'optativa', 800.00, 3),
(60, 'Redes de Computadores', 4, 2, NULL, 'optativa', 800.00, 3),
(61, 'Banco de Dados I', 3, 2, NULL, 'obrigatória', 600.00, 3),
(62, 'Fundamentos de Inteligência Artificial', 3, 2, NULL, 'optativa', 600.00, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas_alunos`
--

CREATE TABLE `disciplinas_alunos` (
  `aluno_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas_alunos`
--

INSERT INTO `disciplinas_alunos` (`aluno_id`, `disciplina_id`) VALUES
(24, 27),
(24, 28),
(24, 29),
(24, 30),
(24, 31),
(24, 33),
(28, 45),
(28, 46),
(28, 47),
(28, 48),
(28, 49),
(30, 27),
(30, 28),
(30, 29),
(30, 30),
(30, 31),
(34, 51),
(35, 27),
(35, 28),
(35, 29),
(35, 31),
(35, 32),
(37, 33),
(37, 34),
(39, 27),
(39, 29),
(39, 33),
(42, 27),
(42, 29),
(42, 30),
(42, 31),
(45, 27),
(45, 28),
(45, 29),
(45, 30),
(45, 33);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas_cc`
--

CREATE TABLE `disciplinas_cc` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `periodo` int(11) DEFAULT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas_cc`
--

INSERT INTO `disciplinas_cc` (`id`, `nome`, `creditos`, `tipo`, `preco`, `periodo`, `professor_id`, `curso_id`) VALUES
(1, 'Cálculo Diferencial e Integral I', 4, 'obrigatória', 0.00, 1, 27, NULL),
(2, 'Fundamentos de Programação', 4, 'obrigatória', 400.00, 1, NULL, NULL),
(3, 'Lógica para Computação', 4, 'obrigatória', 400.00, 1, NULL, NULL),
(4, 'Lógica Matemática', 3, 'optativa', 0.00, 1, 25, NULL),
(5, 'Introdução à Ciência da Computação', 3, 'obrigatória', 300.00, 1, NULL, NULL),
(6, 'Comunicação e Expressão', 2, 'optativa', 200.00, 1, NULL, NULL),
(7, 'Cálculo Diferencial e Integral II', 4, 'obrigatória', 400.00, 2, NULL, NULL),
(8, 'Estruturas de Dados', 4, 'obrigatória', 400.00, 2, NULL, NULL),
(9, 'Engenharia de Requisitos', 4, '0', 0.00, 2, 29, NULL),
(10, 'Matemática Discreta', 3, 'optativa', 300.00, 2, NULL, NULL),
(11, 'Probabilidade e Estatística', 3, 'optativa', 300.00, 2, NULL, NULL),
(12, 'Teoria dos Grafos', 3, 'optativa', 300.00, 2, NULL, NULL),
(13, 'Programação Orientada a Objetos', 4, 'obrigatória', 400.00, 3, NULL, NULL),
(14, 'Algoritmos Avançados', 4, 'obrigatória', 400.00, 3, NULL, NULL),
(15, 'Sistemas Operacionais', 4, 'optativa', 400.00, 3, NULL, NULL),
(16, 'Redes de Computadores', 4, 'optativa', 400.00, 3, NULL, NULL),
(17, 'Banco de Dados I', 3, 'obrigatória', 300.00, 3, NULL, NULL),
(18, 'Fundamentos de Inteligência Artificial', 3, 'optativa', 300.00, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas_es`
--

CREATE TABLE `disciplinas_es` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `creditos` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `periodo` int(11) DEFAULT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas_es`
--

INSERT INTO `disciplinas_es` (`id`, `nome`, `creditos`, `tipo`, `preco`, `periodo`, `professor_id`, `curso_id`) VALUES
(1, 'Cálculo Diferencial e Integral I', 4, '0', 300.00, 1, 29, NULL),
(2, 'Fundamentos de Programação', 4, 'obrigatória', 0.00, 1, 29, NULL),
(3, 'Introdução à Engenharia de Software', 4, 'obrigatória', 400.00, 1, NULL, NULL),
(4, 'Lógica Matemática', 3, 'optativa', 300.00, 1, NULL, NULL),
(5, 'Álgebra Linear', 3, '0', 100.00, 1, 25, NULL),
(6, 'Comunicação e Expressão', 2, 'optativa', 0.00, 1, 27, NULL),
(7, 'Cálculo Diferencial e Integral II', 4, 'obrigatória', 0.00, 2, 29, NULL),
(8, 'Estruturas de Dados', 4, 'optativa', 400.00, 2, NULL, NULL),
(9, 'Engenharia de Requisitos', 4, 'obrigatória', 0.00, 2, 25, NULL),
(10, 'Probabilidade e Estatística', 3, 'optativa', 300.00, 2, NULL, NULL),
(11, 'Matemática Discreta', 3, 'optativa', 300.00, 2, NULL, NULL),
(12, 'Fundamentos de Banco de Dados', 3, 'obrigatória', 300.00, 2, NULL, NULL),
(13, 'Programação Orientada a Objetos', 4, 'obrigatória', 400.00, 3, NULL, NULL),
(14, 'Engenharia de Software I', 4, 'optativa', 400.00, 3, NULL, NULL),
(15, 'Sistemas Operacionais', 4, 'obrigatória', 400.00, 3, NULL, NULL),
(16, 'Algoritmos Avançados', 4, 'obrigatória', 400.00, 3, NULL, NULL),
(17, 'Banco de Dados II', 3, 'obrigatória', 300.00, 3, NULL, NULL),
(18, 'Gestão de Projetos de Software', 3, 'obrigatória', 300.00, 3, NULL, NULL),
(19, 'teste', 3, 'optativa', 0.00, NULL, 27, NULL),
(20, 'teste', 3, 'optativa', 0.00, NULL, 27, NULL),
(21, 'teste2', 3, 'optativa', 0.00, NULL, 27, NULL),
(23, 'testesdsds', 3, '0', 100.00, 1, 27, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `data_matricula` date DEFAULT NULL,
  `status` enum('ativa','cancelada') DEFAULT 'ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `aluno_id`, `disciplina_id`, `data_matricula`, `status`) VALUES
(4, 24, 27, NULL, 'ativa'),
(5, 28, 28, NULL, 'ativa'),
(6, 22, 28, NULL, 'ativa'),
(7, 24, 35, NULL, 'ativa'),
(8, 22, 27, NULL, 'ativa'),
(9, 22, 27, NULL, 'ativa'),
(10, 22, 27, NULL, 'ativa'),
(11, 34, 27, NULL, 'ativa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `data_notificacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `aluno_id`, `disciplina_id`, `periodo`, `data_notificacao`) VALUES
(1, 30, 28, 1, '2024-09-04 03:50:27'),
(2, 30, 29, 1, '2024-09-04 03:50:39'),
(3, 30, 30, 1, '2024-09-04 03:50:41'),
(4, 30, 31, 1, '2024-09-04 03:50:43'),
(5, 30, 32, 1, '2024-09-04 03:50:45'),
(6, 30, 30, 1, '2024-09-04 03:54:13'),
(7, 30, 28, 1, '2024-09-04 03:56:54'),
(8, 30, 30, 1, '2024-09-04 03:56:55'),
(9, 30, 28, 1, '2024-09-04 03:56:58'),
(10, 30, 30, 1, '2024-09-04 03:57:00'),
(11, 30, 32, 1, '2024-09-04 03:57:02'),
(12, 30, 31, 1, '2024-09-04 03:57:04'),
(13, 30, 34, 1, '2024-09-04 03:57:12'),
(14, 30, 33, 1, '2024-09-04 03:57:18'),
(15, 30, 34, 1, '2024-09-04 03:57:20'),
(16, 30, 33, 1, '2024-09-04 03:57:20'),
(17, 30, 32, 1, '2024-09-04 03:57:21'),
(18, 30, 31, 1, '2024-09-04 03:57:21'),
(19, 30, 30, 1, '2024-09-04 03:57:22'),
(20, 30, 29, 1, '2024-09-04 03:57:22'),
(21, 30, 28, 1, '2024-09-04 03:59:12'),
(22, 30, 27, 1, '2024-09-04 03:59:13'),
(23, 30, 27, 1, '2024-09-04 03:59:16'),
(24, 30, 30, 1, '2024-09-04 03:59:18'),
(25, 30, 31, 1, '2024-09-04 03:59:21'),
(26, 30, 32, 1, '2024-09-04 03:59:23'),
(27, 30, 28, 1, '2024-09-04 03:59:26'),
(28, 30, 29, 1, '2024-09-04 03:59:29'),
(29, 30, 34, 1, '2024-09-04 03:59:33'),
(30, 30, 34, 1, '2024-09-04 03:59:38'),
(31, 30, 32, 1, '2024-09-04 03:59:38'),
(32, 30, 31, 1, '2024-09-04 03:59:39'),
(33, 30, 30, 1, '2024-09-04 03:59:40'),
(34, 30, 29, 1, '2024-09-04 03:59:40'),
(35, 30, 28, 1, '2024-09-04 04:01:53'),
(36, 30, 27, 1, '2024-09-04 04:01:54'),
(37, 30, 30, 1, '2024-09-04 04:01:58'),
(38, 30, 31, 1, '2024-09-04 04:02:02'),
(39, 30, 32, 1, '2024-09-04 04:02:04'),
(40, 30, 27, 1, '2024-09-04 04:02:08'),
(41, 30, 28, 1, '2024-09-04 04:02:09'),
(42, 30, 32, 1, '2024-09-04 04:04:49'),
(43, 30, 31, 1, '2024-09-04 04:04:49'),
(44, 30, 30, 1, '2024-09-04 04:04:50'),
(45, 30, 28, 1, '2024-09-04 04:04:50'),
(46, 30, 27, 1, '2024-09-04 04:04:50'),
(47, 30, 27, 1, '2024-09-04 04:04:57'),
(48, 30, 30, 1, '2024-09-04 04:05:00'),
(49, 30, 31, 1, '2024-09-04 04:05:02'),
(50, 30, 31, 1, '2024-09-04 04:05:07'),
(51, 30, 30, 1, '2024-09-04 04:05:07'),
(52, 30, 27, 1, '2024-09-04 04:05:08'),
(53, 30, 33, 1, '2024-09-04 04:05:18'),
(54, 30, 27, 1, '2024-09-04 04:05:21'),
(55, 30, 28, 1, '2024-09-04 04:05:23'),
(56, 30, 29, 1, '2024-09-04 04:05:25'),
(57, 30, 33, 1, '2024-09-04 04:14:24'),
(58, 30, 29, 1, '2024-09-04 04:14:24'),
(59, 30, 28, 1, '2024-09-04 04:25:01'),
(60, 30, 27, 1, '2024-09-04 04:25:01'),
(61, 30, 27, 1, '2024-09-04 04:25:09'),
(62, 30, 30, 1, '2024-09-04 04:25:12'),
(63, 30, 31, 1, '2024-09-04 04:25:13'),
(64, 30, 31, 1, '2024-09-04 04:25:49'),
(65, 30, 30, 1, '2024-09-04 04:25:49'),
(66, 30, 27, 1, '2024-09-04 04:25:50'),
(67, 30, 27, 1, '2024-09-04 04:27:45'),
(68, 30, 29, 1, '2024-09-04 04:27:46'),
(69, 30, 30, 1, '2024-09-04 04:27:53'),
(70, 30, 31, 1, '2024-09-04 04:27:53'),
(71, 30, 31, 1, '2024-09-04 04:28:19'),
(72, 30, 30, 1, '2024-09-04 04:28:20'),
(73, 30, 29, 1, '2024-09-04 04:28:20'),
(74, 30, 27, 1, '2024-09-04 04:28:21'),
(75, 30, 27, 1, '2024-09-04 04:39:43'),
(76, 30, 30, 1, '2024-09-04 04:39:49'),
(77, 30, 31, 1, '2024-09-04 04:39:50'),
(78, 30, 29, 1, '2024-09-04 04:46:56'),
(79, 24, 28, 1, '2024-09-04 04:50:07'),
(80, 30, 28, 1, '2024-09-04 05:09:18'),
(81, 30, 32, 1, '2024-09-04 05:09:22'),
(82, 30, 29, 1, '2024-09-04 05:13:12'),
(83, 30, 31, 1, '2024-09-04 05:13:26'),
(84, 30, 30, 1, '2024-09-04 05:13:29'),
(85, 34, 51, 1, '2024-09-04 05:26:23'),
(86, 24, 33, 1, '2024-09-04 05:26:57'),
(87, 35, 33, 1, '2024-09-04 05:36:41'),
(88, 36, 51, 1, '2024-09-04 05:37:52'),
(89, 36, 46, 1, '2024-09-04 05:37:59'),
(90, 36, 47, 1, '2024-09-04 05:38:02'),
(91, 36, 50, 1, '2024-09-04 05:38:07'),
(92, 36, 45, 1, '2024-09-04 05:38:11'),
(93, 36, 49, 1, '2024-09-04 05:38:14'),
(94, 36, 45, 1, '2024-09-04 05:39:41'),
(95, 24, 27, 1, '2024-09-04 05:41:07'),
(96, 24, 29, 1, '2024-09-04 05:41:09'),
(97, 24, 30, 1, '2024-09-04 05:41:10'),
(98, 24, 31, 1, '2024-09-04 05:41:11'),
(99, 35, 34, 1, '2024-09-04 05:43:23'),
(100, 35, 27, 1, '2024-09-04 05:45:26'),
(101, 35, 29, 1, '2024-09-04 05:45:29'),
(102, 35, 31, 1, '2024-09-04 05:45:35'),
(103, 35, 32, 1, '2024-09-04 05:45:38'),
(104, 35, 28, 1, '2024-09-04 05:45:41'),
(105, 34, 51, 1, '2024-09-04 06:00:31'),
(106, 37, 33, 1, '2024-09-04 06:01:31'),
(107, 37, 34, 1, '2024-09-04 06:02:10'),
(108, 38, 52, 1, '2024-09-04 06:05:39'),
(109, 37, 34, 1, '2024-09-04 06:08:20'),
(110, 39, 27, 1, '2024-09-04 10:32:42'),
(111, 39, 27, 1, '2024-09-04 10:33:00'),
(112, 39, 29, 1, '2024-09-04 10:33:27'),
(113, 39, 30, 1, '2024-09-04 10:33:32'),
(114, 39, 31, 1, '2024-09-04 10:33:36'),
(115, 39, 33, 1, '2024-09-04 10:34:02'),
(116, 42, 27, 1, '2024-09-04 11:31:49'),
(117, 42, 29, 1, '2024-09-04 11:31:52'),
(118, 42, 30, 1, '2024-09-04 11:31:57'),
(119, 42, 31, 1, '2024-09-04 11:32:00'),
(120, 42, 33, 1, '2024-09-04 11:32:26'),
(121, 42, 35, 1, '2024-09-04 11:32:39'),
(122, 45, 27, 1, '2024-09-04 12:08:33'),
(123, 45, 29, 1, '2024-09-04 12:08:47'),
(124, 45, 28, 1, '2024-09-04 12:08:54'),
(125, 45, 30, 1, '2024-09-04 12:09:04'),
(126, 45, 31, 1, '2024-09-04 12:09:07'),
(127, 45, 33, 1, '2024-09-04 12:09:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `periodos_matricula`
--

CREATE TABLE `periodos_matricula` (
  `id` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('aluno','professor','secretario') NOT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `curso_id`) VALUES
(22, 'claudia', 'claudia@gmail.com', '$2y$10$Te2.DCQoIGq.TAEY3k0ruOdYvXo3nu/Mnj0DYbYQZ0jtT/1qRXGGK', 'aluno', 1),
(24, 'gustavo', 'gustavo@gmail.com', '$2y$10$4g4InumNAbKAh60KAPQtKuPN.1pwMMuxfAGJTj2XfJqcyb3gfkrYe', 'aluno', 1),
(25, 'nery', 'nery@gmail.com', '$2y$10$tkVR0WquU59FpBFgMjPYHeWwHuMVbPKA6QKbasp4ie5oVbVYZ9vOK', 'professor', NULL),
(26, 'marina', 'marina@gmail.com', '$2y$10$XfbKK95kijG7FYIp0TAWP.qLYMmTKEGgdfFmIEeu/kQD7k4NkQ4s2', 'secretario', NULL),
(27, 'junior', 'junior@gmail.com', '$2y$10$KRaM9IIGnlO6YCtu4spWpuPsgvVj0uifTS/S0nlq7YsxIPibkpZ8K', 'professor', NULL),
(28, 'luidi', 'luidi@gmail.com', '$2y$10$yAwvI2upXuulcjZ6yK4orOgQXEW7ByLRmxHn5kgKPWC7FgKm1UJmG', 'aluno', 2),
(29, 'marli', 'marli@gmail.com', '$2y$10$F2ZpKwXTMdSYCzY2r.THk.gxiqzmSX4pBaGdPnQY8pNUE/3giLdES', 'professor', NULL),
(30, 'camilinha', 'camila@gmail.com', '$2y$10$56pnmdqPX.FEzPNxxUSM1.4IT7FSMLQ.x2LtuulXA3U1QLdGXBY.u', 'aluno', 1),
(31, 'sophia', 'sophia@gmail.com', '$2y$10$xfXgvc9rWjXGggIKiSD8TutjLljaqVIqb1.O47XjT6RFSgXWKh3iC', 'professor', NULL),
(32, 'karol', 'karol@gmail.com', '$2y$10$2tgfq9Zl2Aov5716PquXIOgsFVjKEJ2sdi03pZhuk6ANijPO.WIQq', 'professor', NULL),
(33, 'testando o site', 'testesite@gmail.com', '$2y$10$vchOs.oIjBLNMBVDGNi3EeGGpZzJBbwCi0SFngN/GlMxam.0bPOlS', 'professor', NULL),
(34, 'testando o site', 'testesite2@gmail.com', '$2y$10$zyGNIxTv9rTJIScAFFJBauAvewX6WKyzkvLNQgWUlrjKXLqzLOKZ2', 'aluno', 2),
(35, 'gugu', 'gugu@gmail.com', '$2y$10$gvrpeusZL0X.3C4r9GYmf.1FI9G5MTSqeJIzqH8oxKyg/BUhTEYx.', 'aluno', 1),
(36, 'cams', 'cams@gmail.com', '$2y$10$7cXm/8MtSiQ0ZBjIhFgRcelTn7JDLpXzNf5L7mwl4bVeUgWliPBsK', 'aluno', 2),
(37, 'flavinho', 'flavinho@gmail.com', '$2y$10$AyETcfjlR5IMhoYn764xPOP7rQwictWArnJMMpjDDwcpUgKdFhc3O', 'aluno', 1),
(38, 'paula', 'paula@gmail.com', '$2y$10$r198c/r5IRqLWC67FG/KfOztnoggmK4cuo0bq.WZhvdJ3UOUpkerS', 'aluno', 2),
(39, 'Ana Luiza', 'analuiza@gmail.com', '$2y$10$bIplmwWQ71A2.ma7ENRQOO61Ikd5i9gBa.ZYWRDvd0qnMM7hGI3Ma', 'aluno', 1),
(40, 'joao', 'joao@gmail.com', '$2y$10$SqZdJKbirK1qUQxMBBqm8.YoeKo.vXXDOhvFN3IegrFpMsACmfweW', 'professor', NULL),
(41, 'lucio', 'lucio@gmail.com', '$2y$10$VYRG/PRSlAWp1ttyVzzWduZrXbm3Z4JmVTeZqJP4/aDXH2mURw6ha', 'secretario', NULL),
(42, 'neimar', 'neimar@gmil.com', '$2y$10$YAjqiMo3jabJjRoCjVaJduVP0xqsSqDlW2MDScIW2gOUU8gqmcjwq', 'aluno', 1),
(43, 'maria', 'maria@gmail.com', '$2y$10$ZTFosVcSnxCn98HD5L.LUu9IN1F98knnY4D6j9xs3MLXLimUrm3R6', 'professor', NULL),
(44, 'luciana', 'luciana@gmail.com', '$2y$10$u1HeQZn5tbGwKBrLIkDnTuG.dG1Eyaj1VsJYJnhbGDdBCW35ZgZkW', 'secretario', NULL),
(45, 'laerte', 'laerte@gmail.com', '$2y$10$VH6KdRgiitugiZ1NIGFl5evVySLTYwn0CE/HnVfx1oujahN6oYbk.', 'aluno', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `disciplina_id` (`disciplina_id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Índices de tabela `disciplinas_alunos`
--
ALTER TABLE `disciplinas_alunos`
  ADD PRIMARY KEY (`aluno_id`,`disciplina_id`),
  ADD KEY `disciplina_id` (`disciplina_id`);

--
-- Índices de tabela `disciplinas_cc`
--
ALTER TABLE `disciplinas_cc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_professor_cc` (`professor_id`);

--
-- Índices de tabela `disciplinas_es`
--
ALTER TABLE `disciplinas_es`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_professor_es` (`professor_id`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `disciplina_id` (`disciplina_id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `disciplina_id` (`disciplina_id`);

--
-- Índices de tabela `periodos_matricula`
--
ALTER TABLE `periodos_matricula`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `curso_id` (`curso_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `disciplinas_cc`
--
ALTER TABLE `disciplinas_cc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `disciplinas_es`
--
ALTER TABLE `disciplinas_es`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de tabela `periodos_matricula`
--
ALTER TABLE `periodos_matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD CONSTRAINT `cobrancas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `cobrancas_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`);

--
-- Restrições para tabelas `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `disciplinas_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `disciplinas_alunos`
--
ALTER TABLE `disciplinas_alunos`
  ADD CONSTRAINT `disciplinas_alunos_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `disciplinas_alunos_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `disciplinas_cc`
--
ALTER TABLE `disciplinas_cc`
  ADD CONSTRAINT `fk_professor_cc` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `disciplinas_es`
--
ALTER TABLE `disciplinas_es`
  ADD CONSTRAINT `fk_professor_es` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `notificacoes_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
