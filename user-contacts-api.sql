
USE `api-users`;
--
-- Estructura de tabla para la tabla `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `lastName` text NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `phone`) VALUES
(1, 'Alicia', 'Puerto', '654474784'),
(2, 'Paqui', 'Roldan', '654674196');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` int(11) NOT NULL,
  `contactName` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_contacts`
--

INSERT INTO `user_contacts` (`id`, `contactName`, `phone`, `user_id`) VALUES
(44, 'Martin', '939916718', 2),
(45, 'Guillermo', '934512114', 2),
(46, 'Paco', '639916718', 1),
(47, 'Adela', '634716718', 1),
(48, 'Angel', '639916712', 1),
(49, 'Mariano', '647916718', 1),
(50, 'Paco', '639916718', 2),
(51, 'Adela', '634716718', 2),
(52, 'Angel', '639916712', 2),
(53, 'Mariano', '647916718', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

