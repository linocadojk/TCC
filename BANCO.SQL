-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Set-2023 às 16:20
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `sistema_login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--
-- Erro ao ler a estrutura para a tabela sistema_login.usuario: #1932 - Table &#039;sistema_login.usuario&#039; doesn&#039;t exist in engine
-- Erro ao ler dados para tabela sistema_login.usuario: #1064 - Você tem um erro de sintaxe no seu SQL próximo a &#039;FROM `sistema_login`.`usuario`&#039; na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--
-- Erro ao ler a estrutura para a tabela sistema_login.usuarios: #1932 - Table &#039;sistema_login.usuarios&#039; doesn&#039;t exist in engine
-- Erro ao ler dados para tabela sistema_login.usuarios: #1064 - Você tem um erro de sintaxe no seu SQL próximo a &#039;FROM `sistema_login`.`usuarios`&#039; na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios2`
--

CREATE TABLE `usuarios2` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios2`
--

INSERT INTO `usuarios2` (`id`, `username`, `password`) VALUES
(1, 'melindagcristina@gmail.com', '$2y$10$C8RTvatQFCgxEGizEtpNgu3UZdgmWCo6/3uK8.RBYDUr3qPNdq.CO'),
(2, '1234', '$2y$10$dZ0VnC2R528E8d.TPaur.e0b7PJiEaE/16JovMTVGaKINjd6hSI1i'),
(3, 'linoca', '$2y$10$V02FhLWyd5O2FN/kOA3eVunl28HJbwRhklsWExjn91uji4Gcgwmj6'),
(4, 'linoca', '$2y$10$ZZQovmmZ6Ud7YWzsXYp/8uJ4npJIxc5xrHeklPt5byoKbUJ3QPkXu'),
(5, 'linoca', '$2y$10$8VsFMe3tPH8lLd9.k0Vgq.nUenoVuRwHo.u2bGeMLfRk6A.RQUz4a'),
(6, 'linoca', '$2y$10$kfD9tDpu7DPeEAxyqhuXvuyKgtqFxceNsPlL7w3Vt6m2Ij1GH9Ot.'),
(7, 'linoca', '$2y$10$4Hn6cai8iS90AVqDIAk0P.pBIl.vQSPB5f4CPxJ26Ie09ZpJ0GFi6'),
(8, 'linoca', '$2y$10$6235Km6gWJCwgZ24ipx0KuJFVGWG5Gb1U7biTredi6sHNwjv10.He'),
(9, 'linoca', '$2y$10$fqtYrU2xShULvnVLGM7ocev4On0GLjGNYNFdMGaTdcmDAp5p1NaW2'),
(10, 'linoca', '$2y$10$1Zw8VBcQX1GSjIxouxC7.uSqdj4c5DMPsajRPaWZ0W8gE74OBb1tW'),
(11, 'linoca', '$2y$10$NTwJLnnJSqZj7QV9PliL2.YqgdHH/qDMbAW0efI0KHXsLxIGbTsiG'),
(12, 'linoca', '$2y$10$ZSQ386AnB3idQVFEFnmIFubevUqEorUgFgdsVoZX2BH3alC1jtThK'),
(13, 'linoca', '$2y$10$CWMbI4UC9MfeMEpBnxdsL.MDRKXW.4yOrv5Km9T95cXFwVbBWONHC'),
(14, 'linoca', '$2y$10$liNfwGImjzwbSnqatXBWFu9YfQmEYIgbxv3r9PUskzw7KRdTFJ7Py'),
(15, 'linoca', '$2y$10$QbT6V/eFIPyhqrrAxsqizuGfPTW7tdsFAVPJnybU9iZizrLcqsSZO'),
(16, 'linoca', '$2y$10$X5sFDkXs7G/Qyx2ArmFouOHwMJ3gUcjbg.Q7vflfW2dDTjGl7xPt.'),
(17, 'linoca', '$2y$10$eryXOqp/egd2R39mWsRmNOB2Yr2.nLaMMxuXvsyJeBN.z8LKVDTiu'),
(18, 'linoca', '$2y$10$DTxCvHav2L9IoxszKGlJ/el60VgRvH/b.LEupu9MTcPIVTTlPx5VS'),
(19, 'linoca', '$2y$10$mwxzpAMOygZyHB8rANSK5eFIHJqs9RwTsmBP5B9NRz3kN5T5iU0QK'),
(20, 'linoca', '$2y$10$TO7OxM.N5iCj855UP.nTw.508xFhksx4W4eJKkaMxY3SoO.RiLaJC'),
(21, 'linoca', '$2y$10$4w3KADvKRmunpw.yZRRhdesyRq9B/QzyeeR3CTOMz2IPYZ5SNBudO'),
(22, 'linoca', '$2y$10$LEF0Mznsb.MsVaR3cdkfdubtCTbkQYgwRdSLEUPFbSHRWC2fM50Ue'),
(23, 'linoca', '$2y$10$7CYHVeMXhPwY1OsbS4ZTQerMmRJdxTfnwSKmP6z6EXAoETOoo7.6W'),
(24, 'linoca', '$2y$10$l0RD2YPE96VXJLT5sm.ixO7fVB8NtsQbS6PkhLjMRLr1dQWu/oIRC'),
(25, 'linoca', '$2y$10$vkL9Uoa8f.Hk/SPqAV.Yb.F42DFxHqshjaWfWsp1FHgOCfi4fK34e'),
(26, 'linoca', '$2y$10$GETujvTvdbukeIUEndEfTe6d1rlbZc3xJ5VI8qcsgVt81CmpfXx/y'),
(27, 'linoca', '$2y$10$bJtH9Pu4z8w1wgNXrR.sa.DSOQbVE7QsBOuMuwKZgoDU7SCHoDPfC'),
(28, 'linoca', '$2y$10$jX1pVKAZMHtDzh1k448lk.2l0Jad0q5GNshU9Giebdms5bqqmqDky'),
(29, 'linoca', '$2y$10$lxmT6h6VFOnlArE.jglxuuGDBnEAkQeZBN2TJjkgIOasTeWbO0dVO'),
(30, 'linoca', '$2y$10$U6gQ8lxwUKRY4IIIVCCaWOWFE1fj2IdS.t44xhCqtMoS4d0jBDAMi'),
(31, 'aa', '$2y$10$h8B7ZXbThszJoB10V9qZDOupwDZJy.5IvZHRVsv9hxLVRP7eBgcXi'),
(32, 'aa', '$2y$10$iD.ZiiY6AAlylbbh1hXruOU.Iph.hpwwvsjNujzoOHVA.5Frbh5tG'),
(33, 'jk', '$2y$10$RZPIIZV11RUuF5I.mWdJWOgktI25AEOatDIrde2FPqTTEV3J941/S'),
(34, '123', '$2y$10$aCWB510w.Xno62XPvzbNm.dz8ceALAllQdw3dWF7O/8uNCu/BD9/2'),
(35, 'SS', '$2y$10$uNgX1BK4IpwqDVbabFytmuq3VqVZFxwZm9EfS3TTZFMrOLTJ1SdBi');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuarios2`
--
ALTER TABLE `usuarios2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios2`
--
ALTER TABLE `usuarios2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;
