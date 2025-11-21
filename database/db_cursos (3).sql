-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2025 a las 00:04:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Programacion'),
(3, 'Marketing'),
(5, 'Ingles'),
(8, 'coso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `titulo`, `descripcion`, `instructor`, `imagen`, `id_categoria`) VALUES
(8, 'Java desde Cero: Fundamentos, Programación Orientada a Objetos y Desarrollo Backend', 'Este curso intensivo te guiará desde los conceptos básicos de Java hasta dominar la Programación Orientada a Objetos (POO), la base de la ingeniería de software moderna. Aprenderás a escribir código Java limpio, modular y reutilizable, preparándote para desarrollar aplicaciones robustas a nivel empresarial.', 'James Gosling', '68eabd3a8b6b0-cursoJava2.jpg', 1),
(10, 'Estrategia de Marketing Digital 360°: De la Captación a la Conversión', 'Este curso te proporcionará una visión integral y práctica del Marketing Digital, enseñándote a diseñar, ejecutar y medir estrategias que realmente impulsan el crecimiento. Aprenderás a navegar el ecosistema digital, desde la creación de contenido hasta la optimización de embudos de venta, garantizando que cada inversión publicitaria genere un retorno real.', 'Lucas Britez', '68eabf154e244-marketing.jpg', 3),
(11, 'Python para Data Science: De Cero a Primer Análisis de Datos con Pandas', 'Este curso te introduce al mundo de la programación Python con un enfoque práctico y directo en el Análisis de Datos. Aprenderás los fundamentos del lenguaje y, lo más importante, cómo utilizar las librerías líderes del sector como Pandas y NumPy para importar, limpiar, transformar y visualizar grandes volúmenes de datos. Al finalizar, estarás listo para enfrentar tus primeros proyectos de Data Science, convertir datos brutos en insights de negocio y construir reportes automáticos.', 'Guido van Rossum', '68ead919c8e09-python.jpg', 1),
(12, 'Comunity managment', 'El curso de Community Management te prepara para gestionar, construir y fortalecer la presencia digital de una marca en redes sociales. Aprenderás a diseñar estrategias de comunicación efectivas, crear contenido atractivo, analizar métricas de desempeño y manejar comunidades online con una voz profesional y coherente.\r\n\r\nA lo largo del curso, conocerás las principales herramientas de gestión, programación y análisis de redes como Instagram, Facebook, TikTok y LinkedIn. Además, aprenderás buenas prácticas para gestionar crisis, aumentar el engagement y optimizar campañas publicitarias.\r\n\r\nIdeal para emprendedores, profesionales del marketing o cualquier persona interesada en posicionar marcas en el entorno digital.', 'Juan Martin del Potro', '68f2e37c5abfc-comunitimanager.jpg', 3),
(15, '1er curso Ingles', 'Aprendé inglés de forma dinámica y práctica. Este curso está diseñado para ayudarte a desarrollar las cuatro habilidades fundamentales del idioma: comprensión auditiva, lectura, escritura y conversación. A través de clases interactivas, ejercicios comunicativos y situaciones reales, mejorarás tu pronunciación, ampliarás tu vocabulario y ganarás confianza para comunicarte en inglés tanto en contextos personales como profesionales.\r\n\r\nIdeal para estudiantes, viajeros o quienes buscan mejorar sus oportunidades laborales en un mundo cada vez más globalizado.', 'Pedro Pascal', '68f67e41db90f-ingles1ier.jpg', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `es_admin` tinyint(1) DEFAULT 0,
  `rol` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `es_admin`, `rol`) VALUES
(1, 'juaniemilio05@gmail.com', '$2y$10$DOXfZvNaVzNiBpTD/GdwW.H0xPCb0mkIVN/mHtfEb7O2GXluFw/Fi', 1, 'admin'),
(5, 'juanceto01@gmail.com', '$2y$10$PDczPGlVP6f47pV12fOXLO4w2EpnsJsOLd7wEBbTYFHXikkTe8ZLS', 1, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curso_categorias` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
