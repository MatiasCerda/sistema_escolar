-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla db_sistema_escolar.grupos: ~2 rows (aproximadamente)
INSERT INTO `grupos` (`id`, `numero`, `nombre`, `descripcion`, `horario`, `creado`) VALUES
	(2, '864115', '5to B', '', NULL, '2025-04-29 11:17:36'),
	(4, '206021', '4to B', '', NULL, '2025-04-29 11:17:47');

-- Volcando datos para la tabla db_sistema_escolar.grupos_alumnos: ~4 rows (aproximadamente)
INSERT INTO `grupos_alumnos` (`id`, `id_grupo`, `id_alumno`) VALUES
	(1, 4, 10),
	(2, 2, 11),
	(3, 2, 12),
	(4, 4, 13);

-- Volcando datos para la tabla db_sistema_escolar.grupos_materias: ~4 rows (aproximadamente)
INSERT INTO `grupos_materias` (`id`, `id_grupo`, `id_mp`) VALUES
	(1, 4, 1),
	(2, 4, 4),
	(3, 2, 1),
	(4, 2, 4);

-- Volcando datos para la tabla db_sistema_escolar.lecciones: ~2 rows (aproximadamente)
INSERT INTO `lecciones` (`id`, `id_materia`, `id_profesor`, `titulo`, `video`, `contenido`, `status`, `fecha_inicial`, `fecha_disponible`, `creado`, `actualizado`) VALUES
	(1, 1, 9, 'Capitulo 5', 'https://www.youtube.com/embed/99I8tt5ZwKE', 'Período prehispánico: Diversas culturas indígenas, como los mapuches, habitaron el territorio chileno antes de la llegada de los europeos.\r\nConquista y colonia: En 1541, Pedro de Valdivia fundó Santiago y comenzó la colonización española, marcada por conflictos con los pueblos originarios', 'publica', '2025-04-28 00:00:00', '2025-05-11 00:00:00', '2025-04-29 14:06:49', '2025-04-29 20:50:45'),
	(2, 2, 8, 'El papa Francisco', 'https://www.youtube.com/embed/MIR9elHUb-s', 'Conversación acerca del papa', 'publica', '2025-04-30 00:00:00', '2025-05-11 00:00:00', '2025-04-29 15:02:46', '2025-04-29 21:03:27');

-- Volcando datos para la tabla db_sistema_escolar.materias: ~2 rows (aproximadamente)
INSERT INTO `materias` (`id`, `nombre`, `descripcion`, `creado`) VALUES
	(2, 'Ciencias Sociales', '', '2025-04-29 11:19:30'),
	(3, 'Historia', '', '2025-04-30 08:31:39');

-- Volcando datos para la tabla db_sistema_escolar.materias_profesores: ~4 rows (aproximadamente)
INSERT INTO `materias_profesores` (`id`, `id_materia`, `id_profesor`) VALUES
	(1, 1, 9),
	(2, 1, 8),
	(3, 2, 8),
	(4, 2, 9),
	(5, 2, 14);

-- Volcando datos para la tabla db_sistema_escolar.posts: ~0 rows (aproximadamente)

-- Volcando datos para la tabla db_sistema_escolar.usuarios: ~6 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `numero`, `nombres`, `apellidos`, `nombre_completo`, `email`, `password`, `telefono`, `hash`, `rol`, `status`, `creado`, `actualizado`) VALUES
	(1, '112233', 'Peter', 'Parker', 'Peter Parker', 'jslocal@localhost.com', '$2y$10$dVRIBkxV/jLzF9cPl8sHT.CSIJ0rwsNSEo/11lp91dcQ5t/j5RRSi', '1122334455', 'jasdjkjasdjkasd', 'root', 'activo', '2025-04-25 12:15:07', '2025-04-30 13:52:12'),
	(8, '698709', 'Elena', 'Fisher', 'Elena Fisher', 'jslocal2@localhost.com', '$2y$10$2eSKib0GRTPUJm1bVClltuS1E41ad.LE67ciy9t2K2E.Pd9ecC9s6', '', 'f4bc8751aecf260a1431d1a3aff2ef886f38ea377ce42bfc2caf3078b782dbe9', 'profesor', 'activo', '2025-04-29 11:15:48', '2025-04-29 17:20:01'),
	(9, '817645', 'Chloe', 'Frezzer', 'Chloe Frezzer', 'jslocal3@localhost.com', '$2y$10$qydM5sHGeQ5O/x1cWq4Gdu1fSle.5S0ueoZcH5KxBGL6W192feUgm', '', '1b1e927ea14d1c169a878dd74fdaa44442ecb7231b17cbd455ddd1fc68573e24', 'profesor', 'activo', '2025-04-29 11:16:40', '2025-04-29 19:09:24'),
	(10, '154083', 'Nathan', 'Drake', 'Nathan Drake', 'jslocal4@localhost.com', '$2y$10$Dz4EQK/QAFWwOhx3VK44UOO00OGYnTRj.tMALZmNSTzsfImQuifWW', '', '39b980a8a11c967d5be91c305fc7d127a55fc1c577808f6558e9860c875b3027', 'alumno', 'activo', '2025-04-29 11:18:20', '2025-04-29 19:09:32'),
	(11, '476661', 'Victor', 'Sullivan', 'Victor Sullivan', 'jslocal5@localhost.com', '$2y$10$/hqZZKdRZTeoLsZ/Cyq19ed4yQKgtoQJBI384t5T4EVZqxagRY0/K', '', '6a6cedfa884fa2813c31536930377396ea14ae8fa8cd8e573eca3c70a4817d11', 'alumno', 'activo', '2025-04-29 11:19:01', '2025-04-29 17:30:22'),
	(13, '942709', 'Mauro', 'Monzon', 'Mauro Monzon', 'jslocal6@localhost.com', '$2y$10$z4MLsgaF398O3a6m.Ut/venYQKfV3hgGy4U6HqTb9hADvsfli2LOm', '', '3d3c14dd0dec2857f8962ec45dd8f04677e56d8bb9c06c30daf7422dced366db', 'alumno', 'activo', '2025-04-29 13:05:22', '2025-04-29 19:07:26'),
	(14, '639869', NULL, NULL, NULL, NULL, NULL, NULL, '30e0276a84add9cd52ea88ae0c1b68b9947c15f3b4b147fb1722158f29c94020', 'profesor', 'pendiente', '2025-04-30 08:32:26', '2025-04-30 14:32:26'),
	(15, '608316', NULL, NULL, NULL, NULL, NULL, NULL, '44c783709f3059b17683c39990d43a3421a236e461b320ee2818b088c9df3f3f', 'profesor', 'pendiente', '2025-04-30 10:37:37', '2025-04-30 16:37:37'),
	(16, '198021', NULL, NULL, NULL, NULL, NULL, NULL, 'd7ffcc6187da25a3b466ac7ac19fa67f9c53a1ebaef7b938d850005a0b6bba17', 'profesor', 'pendiente', '2025-04-30 10:37:39', '2025-04-30 16:37:39'),
	(17, '454759', NULL, NULL, NULL, NULL, NULL, NULL, '656eba67983f52f332c1c046b24d96939656cbd5eeb33677a036c034ded81221', 'profesor', 'pendiente', '2025-04-30 10:37:41', '2025-04-30 16:37:41'),
	(18, '954235', NULL, NULL, NULL, NULL, NULL, NULL, '5b9f774ecba9766c59fd066fac1351fece1131b08b9fb91168b58d4c2068f6e6', 'profesor', 'pendiente', '2025-04-30 10:37:42', '2025-04-30 16:37:42'),
	(19, '580630', NULL, NULL, NULL, NULL, NULL, NULL, '26914d2e69bd24717e04a8053270172f765b7d2470ec282758dbcdfe7ffeb2fb', 'profesor', 'pendiente', '2025-04-30 10:37:43', '2025-04-30 16:37:43');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
