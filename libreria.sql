-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2025 a las 22:13:56
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
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Autoayuda'),
(2, 'Novela de fantasía'),
(3, 'Novela Negra'),
(4, 'Novela contemporánea'),
(5, 'Thriller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_libro`, `id_usuario`, `fecha`, `cantidad`) VALUES
(1, 2, '2022-02-27', 1),
(1, 3, '2025-04-07', 2),
(1, 13, '2020-10-12', 1),
(2, 2, '2023-06-15', 1),
(2, 3, '2025-04-07', 2),
(3, 1, '2024-05-23', 1),
(4, 1, '2024-05-23', 1),
(4, 3, '2025-04-07', 2),
(5, 2, '2024-04-17', 1),
(5, 3, '2025-04-07', 1),
(10, 1, '2024-05-23', 1),
(10, 2, '2025-03-01', 1),
(10, 3, '2025-04-07', 2),
(10, 4, '2008-10-16', 1),
(10, 14, '2021-08-20', 1),
(11, 1, '2024-05-23', 1),
(12, 2, '2025-02-05', 1),
(13, 3, '2023-07-20', 1),
(14, 3, '2024-12-17', 1),
(15, 3, '2025-03-02', 1),
(16, 1, '2024-05-23', 1),
(16, 2, '2025-03-15', 1),
(16, 14, '2022-01-15', 1),
(17, 1, '2024-05-23', 1),
(17, 2, '2025-04-06', 1),
(17, 14, '2022-10-19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `paginas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `categorias` text NOT NULL,
  `editorial` text NOT NULL,
  `sinopsis` text NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `disponible` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `precio`, `paginas`, `fecha`, `categorias`, `editorial`, `sinopsis`, `imagen`, `disponible`) VALUES
(1, 'Hábitos atómicos', 'James Clear', 23.9, 328, '2018-10-16', 'Autoayuda', 'Diana Editorial', 'A menudo pensamos que para cambiar de vida tenemos que pensar en hacer cambios grandes. Nada más lejos de la realidad. Según el reconocido experto en hábitos James Clear, el cambio real proviene del resultado de cientos de pequeñas decisiones: hacer dos flexiones al día, levantarse cinco minutos antes o hacer una corta llamada telefónica. Clear llama a estas decisiones “hábitos atómicos”: tan pequeños como una partícula, pero tan poderosos como un tsunami. En este libro innovador nos revela exactamente cómo esos cambios minúsculos pueden crecer hasta llegar a cambiar nuestra carrera profesional, nuestras relaciones y todos los aspectos de nuestra vida.', 'HabitosAtomicos.jpg', 0),
(2, 'Alas de Sangre (Empíreo 1)', 'Rebeca Yarros', 26.9, 736, '2023-04-05', 'Novela de fantasía', 'Editorial Planeta', 'Violet Sorrengail creía que se uniría al Cuadrante de los Escribas para vivir una vida tranquila, sin embargo, por órdenes de su madre, debe unirse a los miles de candidatos que, en el Colegio de Guerra de Basgiath, luchan por formar parte de la élite de Navarre: el Cuadrante de los Jinetes de dragón. Cuando eres más pequeña y frágil que los demás tu vida corre peligro, porque los dragones no se vinculan con humanos débiles. Además, con más jinetes que dragones disponibles, muchos la matarían con tal de mejorar sus probabilidades de éxito; y hay otros, como el despiadado Xaden Riorson, el líder de ala más poderoso del Cuadrante de Jinetes, que la asesinarían simplemente por ser la hija de la comandante general. Para sobrevivir, necesitará aprovechar al máximo todo su ingenio. Mientras la guerra se torna más letal Violet sospecha que los líderes de Navarre esconden un terrible secreto...', 'AlasSangre1.jpg', 1),
(3, 'Un animal salvaje', 'Joël Dicker', 23.9, 448, '2024-04-04', 'Novela Negra', 'Alfaguara', 'El 2 de julio de 2022, dos delincuentes se disponen a robar en una importante joyería de Ginebra. Un incidente que dista mucho de ser un vulgar atraco. Veinte días antes, en una lujosa urbanización a orillas del lago Lemán, Sophie Braun se prepara para celebrar su cuadragésimo cumpleaños. La vida le sonríe: vive con su familia en una mansión rodeada de bosques, pero su idílico mundo está a punto de tambalearse. Su marido anda enredado en sus pequeños secretos. Su vecino, un policía de reputación irreprochable, se ha obsesionado con ella y la espía hasta en los detalles más íntimos. Y un misterioso merodeador le hace un regalo que pone su vida en peligro. Serán necesarios varios viajes al pasado, lejos de Ginebra, para hallar el origen de esta intriga diabólica de la que nadie saldrá indemne.', 'AnimalSalvaje.jpg', 1),
(4, 'La grieta del silencio', 'Javier Castillo', 12.95, 448, '2024-04-16', 'Novela contemporánea', 'Suma', 'Staten Island, 1981. La bicicleta de Daniel Miller aparece abandonada en las inmediaciones de su casa. No hay rastro del pequeño. Treinta años después, en 2011, la periodista de investigación del Manhattan Press Miren Triggs sigue una pista que la conduce hasta el terrible hallazgo de un cadáver con los labios sellados.Miren Triggs y Jim Schmoer, su antiguo profesor de periodismo, tratarán de descubrir qué vincula ambos casos mientras ayudan a Ben Miller, padre de Daniel y ex inspector del FBI, a reconstruir por última vez la desaparición de su hijo. Se adentrarán así en las profundidades de un enigma lleno de recovecos en los que resuenan las voces del pasado. ¿Qué le sucedió a Daniel? ¿Quién se esconde tras el horrible asesinato? ¿Puede el silencio ser el refugio de la verdad?', 'GrietaDelSilencio.jpg', 1),
(5, 'Alas de hierro (Empíreo 2)', 'Rebeca Yarros', 26.9, 896, '2024-02-21', 'Novela de fantasía', 'Editorial Planeta', 'Todos esperaban que Violet Sorrengail muriera en su primer año en el Colegio de Guerra Basgiath, incluso ella misma. Pero la Trilla fue tan solo la primera de una serie de pruebas imposibles destinadas a deshacerse de los indignos y los desafortunados. Ahora comienza el verdadero entrenamiento, y Violet no sabe cómo logrará superarlo. No solo porque es brutal y agotador o porque está diseñado para llevar al límite el umbral del dolor de los jinetes, sino porque el nuevo vicecomandante está empeñado en demostrarle lo débil que es, a menos que traicione al hombre al que ama. La voluntad de sobrevivir no será suficiente porque Violet conoce el secreto que se oculta entre los muros del colegio, y nada, ni siquiera el fuego de dragón, será suficiente para salvarlos. Increíblemente peligrosa y adictiva, no te pierdas la continuación de Alas de sangre, el gran fenómeno internacional.', 'AlasHierro2.jpg', 1),
(6, 'Recupera tu mente, reconquista tu vida', 'Marian Rojas Estapé', 20.9, 384, '2024-04-03', 'Autoayuda', 'Espasa', 'Cada vez estamos más impacientes e irritables y toleramos menos el dolor. ¿Notas que te cuesta más prestar atención? ¿Quién no ha sentido ansiedad en el último año? ¿Quién no tolera peor el aburrimiento y el dolor? ¿Notas que te cuesta más prestar atención? Vivimos en la era de la gratificación instantánea, en la cultura de la inmediatez y las recompensas, buscamos la felicidad a golpe de clic. Llevamos una vida agitada e intensa, y con el modo fast activado. Somos drogodependientes emocionales inundados de múltiples distracciones. Todo esto tiene un impacto en nuestra capacidad de prestar atención a lo importante, de profundizar y de concentrarnos. La buena noticia es que podemos rescatar la atención perdida, volver a reconectar con nosotros mismos y con todo lo maravilloso que nos rodea para encontrar ese equilibrio emocional que tanto ansiamos.', 'RecuperaTuMente.jpg', 1),
(7, 'Las hijas de la criada', 'Sonsoles Ónega', 14.95, 480, '2023-11-08', 'Novela Negra', 'Booket', 'Una noche de febrero de 1900, recien estrenado el siglo XX, en el pazo de Espíritu Santo llegan al mundo dos niñas, Clara y Catalina, cuyos destinos ya estaban escritos. Sin embargo, una venganza inesperada sacudirá para siempre sus vidas y las de todos los Valdes.Doña Ines, matriarca de la saga y fiel esposa de don Gustavo, deberá sobrevivir al desamor, al dolor del abandono y a las luchas de poder hasta convertir a su verdadera hija en heredera de todo un imperio, en una epoca en la que a las mujeres no se les permitía ser dueñas de sus vidas.', 'HijasCriada.jpg', 1),
(8, 'Cómo hacer que te pasen cosas buenas', 'Marian Rojas Estapé', 20.9, 232, '2018-10-09', 'Autoayuda', 'Espasa', '¿Eres consciente de que tu manera de gestionar los conflictos te puede predisponer a sufrir ansiedad o depresión, las enfermedades más frecuentes del siglo XXI?Para la doctora Marian Rojas Estapé la felicidad consiste en vivir instalado de forma sana en el presente, habiendo superado las heridas del pasado y mirando con ilusión al futuro. Muchos de los trastornos que padecemos provienen de la incapacidad para gestionar nuestro presente. La felicidad no es lo que nos pasa, sino cómo interpretamos lo que nos pasa.En Cómo hacer que te pasen cosas buenas entenderás la importancia de aprender a enfocar tu atención y descubrirás pautas para combatir los miedos, las angustias y cómo canalizar las emociones negativas que te llegan a bloquear física y mentalmente', 'CosasBuenas.jpg', 1),
(9, 'El niño que perdió la guerra', 'Julia Navarro', 24.9, 640, '2024-09-05', 'Novela contemporánea', 'Plaza&Janes', 'Madrid, invierno de 1938: Clotilde, una artista gráfica que dibuja caricaturas para los diarios republicanos, asiste en Madrid a los últimos meses de la Guerra Civil. La caída de la República es inminente, por lo que su marido, militante comunista que trabaja para los rusos, decide enviar a Moscú a su hijo Pablo, de tan solo cinco años, en contra de su voluntad. Clotilde se resiste con todas sus fuerzas, pero no logra evitar que el comandante Borís Petrov emprenda ese arriesgado viaje por una España en llamas para cumplir con el deseo de su camarada de llevar a Pablo a la Unión Soviética, donde Stalin está levantando un nuevo país sobre las ruinas del antiguo régimen.\nMoscú, primavera de 1939: Allí es recibido por su nueva familia que, conmovida por su trágico exilio, acoge con afecto a un niño exhausto y enfermo. Anya no duda en cuidar de Pablo como si fuese su propio hijo, sin hacer distinciones con Igor, su hermano de adopción. Hija y esposa de dos orgullosos héroes de la Revolución -su padre luchó junto a Lenin, su marido a las órdenes de Stalin-, Anya ama la poesía y la música, aficiones sospechosas y burguesas a los ojos del poder. Mientras sus ilusiones naufragan en el ambiente cada vez más opresivo del terror estalinista, su espíritu se rebela contra la injusticia, la miseria, la ausencia de libertad y el Gulag.', 'NiñoGuerra.jpg', 1),
(10, 'El señor de los anillos: la Comunidad del Anillo', 'J.R.R. Tolkien', 19.95, 704, '1954-07-29', 'Novela de fantasía', 'Booket', 'La primera entrega de la trilogía de J. R. R. Tolkien El Señor de los Anillos. Empieza tu viaje a la Tierra Media. Edición revisada.\r\n\r\nUn héroe inesperado. Una misión peligrosa. La mayor aventura que jamás te hayan contado.\r\n\r\nEn la adormecida e idílica Comarca, un joven hobbit recibe un encargo: custodiar el Anillo Único y emprender el viaje para su destrucción en la Grieta del Destino. Acompañado por magos, hombres, elfos y enanos, atravesará la Tierra Media y se internará en las sombras de Mordor, perseguido siempre por las huestes de Sauron, el Señor Oscuro, dispuesto a recuperar su creación para establecer el dominio definitivo del Mal.', 'LOTR1.jpg', 1),
(11, 'La historia interminable', 'Michael Ende', 15.95, 400, '1979-01-01', 'Novela de fantasía', 'Alfaguara', 'La Emperatriz Infantil está mortalmente enferma y su reino, Fantasia, corre un grave peligro. La salvación depende de Atreyu, un valiente guerrero de la tribu de los pieles verdes, y Bastian, un niño tímido que lee con pasión un libro mágico. Solo un ser humano puede salvar este lugar encantado. Juntos emprenderán un fascinante viaje a traves de tierras de dragones, gigantes, monstruos y magia que no tiene vuelta atrás. A medida que se adentra en Fantasia, Bastian deberá resolver tambien los misterios de su propio corazón.', 'HistoriaInterminable.jpg', 1),
(12, 'Alas de Ónix (Empíreo 3)', 'Rebeca Yarros', 23.9, 896, '2025-01-22', 'Novela de fantasía', 'Editorial Planeta', 'Tras casi dieciocho meses en el Colegio de Guerra Basgiath, Violet Sorrengail tiene claro que no queda tiempo para entrenar. Hay que tomar decisiones. La batalla ha comenzado y, con enemigos acercándose a las murallas e infiltrados en sus propias filas, es imposible saber en quién confiar.\r\n\r\nAhora Violet deberá emprender un viaje fuera de los límites de Aretia, en busca de aliados de tierras desconocidas que acepten pelear por Navarre. La misión pondrá a prueba su suerte, y la obligará a usar todo su ingenio y fortaleza para salvar lo que más ama: sus dragones, su familia, su hogar y a él.\r\n\r\nAunque eso signifique tener que guardar un secreto tan peligroso que podría destruirlo todo.\r\n\r\nNavarre necesita un ejército. Necesita poder. Necesita magia. Y necesitará algo que solo Violet puede encontrar: la verdad.\r\n\r\nPero una tormenta se aproxima… y no todos sobrevivirán a su furia.', 'AlasOnix3.jpg', 1),
(13, 'La Asistenta', 'Freida McFadden', 19.9, 344, '2023-05-10', 'Thriller', 'Suma', 'Todos los días friego la preciosa casa de los Winchester de arriba abajo. Recojo a su hija del colegio y preparo deliciosas comidas para toda la familia antes de subir a cenar sola en mi minúscula habitación del piso superior.Intento no prestar atención a Nina cuando lo ensucia todo simplemente para ver cómo lo limpio. A las extrañas mentiras que cuenta sobre su propia hija. A su marido, que cada día parece más abatido. Pero cuando miro a Andrew a los ojos, castaños, encantadores y llenos de dolor, no me resulta difícil imaginar cómo sería vivir en la piel de Nina. El gran vestidor, el coche de lujo, el esposo perfecto.\r\n\r\nHasta que un día no me resisto a probarme uno de sus maravillosos vestidos blancos. Solo quiero saber que se siente. Pero ella pronto lo descubre, y cuando me doy cuenta de que la puerta de mi habitación solo se cierra por fuera ya es demasiado tarde.', 'Asistenta1.jpg', 1),
(14, 'El secreto de la Asistenta', 'Freida McFadden', 20.9, 336, '2024-05-09', 'Thriller', 'Suma', 'Es difícil encontrar a alguien que te de trabajo sin preguntar demasiado sobre tu pasado. Así que le agradezco al universo que, milagrosamente, los Garrick me hayan dado empleo limpiando su impresionante ático con vistas a todo Manhattan y preparándoles comidas sofisticadas en su inmensa cocina. Puedo trabajar aquí durante un tiempo, ser discreta hasta conseguir lo que quiero.\r\n\r\nEs casi perfecto. Sin embargo, todavía no he conocido a la señora Garrick ni he podido ver lo que hay dentro de la habitación de invitados. Estoy segura de que la oigo llorar. Veo las pequeñas manchas de sangre en el cuello de sus camisones blancos cuando hago la colada. Y, un día, no puedo evitar llamar a su puerta. Cuando esta se abre lentamente, lo que veo lo cambia todo...\r\n\r\nEs entonces cuando hago una promesa. Douglas Garrick se ha equivocado. Y va a pagar. Es todo una cuestión de hasta dónde estoy dispuesta a llegar...', 'Asistenta2.jpg', 1),
(15, 'La Asistenta te vigila', 'Freida McFadden', 20.9, 368, '2024-07-11', 'Thriller', 'Suma', 'Yo solía trabajar limpiando las casas de otras personas, ahora apenas puedo creerme que este sea mi hogar. La encantadora cocina, la calle tranquila, el enorme jardín en el que los niños pueden jugar. Mi marido y yo hemos ahorrado durante años para que mis hijos tengan la vida que se merecen.\r\n\r\nAunque siento algo de recelo hacia nuestra vecina, la señora Lowell, veo su invitación a cenar como una oportunidad para hacer amigos. Cuando su doncella abre la puerta con un delantal blanco y el pelo recogido en un moño tirante, se exactamente cómo se siente. Pero su gelida mirada me produce escalofríos...\r\n\r\nLa doncella de los Lowell no es lo único extraño de nuestra calle. Estoy convencida de que alguien nos observa. Y cuando conozco a la mujer que vive enfrente, sus palabras me dejan petrificada: \"Ten cuidado con tus vecinos\".\r\n\r\n¿Cometí un terrible error mudándome aquí con mi familia?', 'Asistenta3.jpg', 1),
(16, 'El señor de los anillos: las dos torres', 'J.R.R. Tolkien', 19.95, 592, '1954-11-11', 'Novela de fantasía', 'Booket', 'La Compañía se ha disuelto y sus integrantes emprenden caminos separados. Frodo y Sam avanzan solos en su viaje a lo largo del río Anduin, perseguidos por la sombra misteriosa de un ser extraño que tambien ambiciona la posesión del Anillo. Mientras, hombres, elfos y enanos se preparan para la batalla final contra las fuerzas del Señor del Mal', 'LOTR2.jpg', 1),
(17, 'El señor de los anillos: el retorno del Rey', 'J.R.R. Tolkien', 19.95, 688, '1955-10-20', 'Novela de fantasía', 'Booket', 'Los ejércitos del Señor Oscuro van extendiendo cada vez más su maléfica sombra por la Tierra Media. Hombres, elfos y enanos unen sus fuerzas para presentar batalla a Sauron y sus huestes. Ajenos a estos preparativos, Frodo y Sam siguen adentrándose en el país de Mordor en su heroico viaje para destruir el Anillo de Poder en las Grietas del Destino.', 'LOTR3.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_categorias`
--

CREATE TABLE `libros_categorias` (
  `id_libro` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros_categorias`
--

INSERT INTO `libros_categorias` (`id_libro`, `id_categoria`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(6, 1),
(7, 3),
(8, 1),
(9, 4),
(10, 2),
(11, 2),
(12, 2),
(13, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Contraseña` varchar(66) NOT NULL,
  `Administrador` tinyint(1) NOT NULL DEFAULT 0,
  `esActivo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Usuario`, `Contraseña`, `Administrador`, `esActivo`) VALUES
(1, 'Mario', '$2y$10$A0nJDUUPB5uU/2djM.9KtenBxJGoYgXTNUCVd7cBlvJw/AaMxORRe', 1, 1),
(2, 'Julia', '$2y$10$46cN0TT4mEFAZM3zxZo9qelpG/.QY4iR0LB.ONAgMtZ/BmENdqCPe', 1, 1),
(3, 'Fabio', '$2y$10$TDl.GgYEg0SKB9S2X6yB6OF8p0xee7cKq0EmsNrjVDNXPa2N31.gC', 1, 1),
(4, 'Usuario', '$2y$10$LiMBsX7EDLup8IJTyZUVJuFZug7FpqPsEVzPkoGdK3zpztsi.tyre', 0, 1),
(13, 'Usuario1', '$2y$10$42roZu8oMWbYqIFD3U691ODvHVUQ/JhHMItQ7fRm4en/uw3cLnTwy', 0, 0),
(14, 'Usuario2', '$2y$10$KQN00b2WNs.94Nfa/pJvLuVZu7qmkaKQeRmR9tB9bOddsh1rm9VDW', 0, 1),
(15, 'test', '$2y$10$Vx6zzAIWLDZuHlNEJwO.8OGzahryjXKwWS.BAvovELeFSuzuNPcQ2', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_libro`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD PRIMARY KEY (`id_libro`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD CONSTRAINT `libros_categorias_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `libros_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
