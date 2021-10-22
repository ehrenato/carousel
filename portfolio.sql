SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cadastrar Informativo', '2021-06-11 00:00:00', '2021-06-11 00:00:00', NULL),
(2, 'Usuários do Sistema', '2021-06-14 00:00:00', '2021-06-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrossel`
--

CREATE TABLE `carrossel` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `post` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `setores` varchar(100) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `fixo` int(11) DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;


--
-- Estrutura da tabela `post_fix`
--

CREATE TABLE `post_fix` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `post` mediumtext NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `fixo` int(11) DEFAULT 0,
  `arquivo` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `setores` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `loginhash` varchar(32) DEFAULT NULL,
  `cadastrado_por` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `setor_id` int(11) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `loginhash`, `cadastrado_por`, `image`, `setor_id`, `perfil`, `status`, `create_at`, `update_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$GWg6.odkqVxh39zcKb6wROw6tMK2/iwdeIdjMjpL1JTel7T1cogPC', '780147c86a6156aa8b29a08438f572b6', 1, NULL, 1, '1,2,3,4,5,6,7,8,9,10', 1, '2021-02-23 19:11:16', '2021-07-19 16:22:34', NULL);

--
-- Índices para tabelas despejadas
--


--
-- Índices para tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);


--
-- Índices para tabela `carrossel`
--
ALTER TABLE `carrossel`
  ADD PRIMARY KEY (`id`);


--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--


--
-- AUTO_INCREMENT de tabela `carrossel`
--
ALTER TABLE `carrossel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;


--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;
