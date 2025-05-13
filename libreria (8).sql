-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2025 a las 14:30:55
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
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre`, `descripcion`) VALUES
(20, 'James Clear', 'Especialista en hábitos atómicos, motivación y desarrollo personal con impacto diario.'),
(21, 'Rebeca Yarros', 'Escritora de novelas románticas y fantasía, conocida por historias intensas y emotivas.'),
(22, 'Joël Dicker', 'Novelista suizo famoso por tramas de misterio, crimen y giros inesperados que atrapan.'),
(23, 'Javier Castillo', 'Autor de thrillers psicológicos con escenarios intrigantes y ritmo vertiginoso.'),
(24, 'Marian Rojas Estapé', 'Psiquiatra y autora que combina ciencia y emociones para mejorar el bienestar mental.'),
(25, 'Sonsoles Ónega', 'Periodista y novelista que retrata con detalle los dilemas personales y sociales.'),
(26, 'Julia Navarro', 'Escritora de bestsellers históricos con tramas políticas, religiosas y muy documentadas.'),
(27, 'J.R.R. Tolkien', 'Autor británico que revolucionó la fantasía épica con mundos ricos y lenguas inventadas.'),
(28, 'Michael Ende', 'Escritor alemán de fantasía, recordado por La historia interminable y Momo.'),
(29, 'Freida McFadden', 'Autora de thrillers médicos y psicológicos con finales impactantes y giros sorprendentes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_compra` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_libro`, `id_usuario`, `fecha`, `cantidad`) VALUES
(1, 9, 1, '2025-04-01', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `id_autor` int(11) NOT NULL,
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

INSERT INTO `libros` (`id_libro`, `titulo`, `id_autor`, `precio`, `paginas`, `fecha`, `categorias`, `editorial`, `sinopsis`, `imagen`, `disponible`) VALUES
(1, 'Hábitos atómicos', 20, 23.9, 328, '2018-10-16', 'Autoayuda', 'Diana Editorial', 'A menudo pensamos que para cambiar de vida tenemos que pensar en hacer cambios grandes. Nada más lejos de la realidad. Según el reconocido experto en hábitos James Clear, el cambio real proviene del resultado de cientos de pequeñas decisiones: hacer dos flexiones al día, levantarse cinco minutos antes o hacer una corta llamada telefónica. Clear llama a estas decisiones “hábitos atómicos”: tan pequeños como una partícula, pero tan poderosos como un tsunami. En este libro innovador nos revela exactamente cómo esos cambios minúsculos pueden crecer hasta llegar a cambiar nuestra carrera profesional, nuestras relaciones y todos los aspectos de nuestra vida.', 'HabitosAtomicos.jpg', 1),
(2, 'Alas de Sangre (Empíreo 1)', 21, 26.9, 736, '2023-04-05', 'Novela de fantasía', 'Editorial Planeta', 'Violet Sorrengail creía que se uniría al Cuadrante de los Escribas para vivir una vida tranquila, sin embargo, por órdenes de su madre, debe unirse a los miles de candidatos que, en el Colegio de Guerra de Basgiath, luchan por formar parte de la élite de Navarre: el Cuadrante de los Jinetes de dragón. Cuando eres más pequeña y frágil que los demás tu vida corre peligro, porque los dragones no se vinculan con humanos débiles. Además, con más jinetes que dragones disponibles, muchos la matarían con tal de mejorar sus probabilidades de éxito; y hay otros, como el despiadado Xaden Riorson, el líder de ala más poderoso del Cuadrante de Jinetes, que la asesinarían simplemente por ser la hija de la comandante general. Para sobrevivir, necesitará aprovechar al máximo todo su ingenio. Mientras la guerra se torna más letal Violet sospecha que los líderes de Navarre esconden un terrible secreto...', 'AlasSangre1.jpg', 1),
(3, 'Un animal salvaje', 22, 23.9, 448, '2024-04-04', 'Novela Negra', 'Alfaguara', 'El 2 de julio de 2022, dos delincuentes se disponen a robar en una importante joyería de Ginebra. Un incidente que dista mucho de ser un vulgar atraco. Veinte días antes, en una lujosa urbanización a orillas del lago Lemán, Sophie Braun se prepara para celebrar su cuadragésimo cumpleaños. La vida le sonríe: vive con su familia en una mansión rodeada de bosques, pero su idílico mundo está a punto de tambalearse. Su marido anda enredado en sus pequeños secretos. Su vecino, un policía de reputación irreprochable, se ha obsesionado con ella y la espía hasta en los detalles más íntimos. Y un misterioso merodeador le hace un regalo que pone su vida en peligro. Serán necesarios varios viajes al pasado, lejos de Ginebra, para hallar el origen de esta intriga diabólica de la que nadie saldrá indemne.', 'AnimalSalvaje.jpg', 1),
(4, 'La grieta del silencio', 23, 12.95, 448, '2024-04-16', 'Novela contemporánea', 'Suma', 'Staten Island, 1981. La bicicleta de Daniel Miller aparece abandonada en las inmediaciones de su casa. No hay rastro del pequeño. Treinta años después, en 2011, la periodista de investigación del Manhattan Press Miren Triggs sigue una pista que la conduce hasta el terrible hallazgo de un cadáver con los labios sellados.Miren Triggs y Jim Schmoer, su antiguo profesor de periodismo, tratarán de descubrir qué vincula ambos casos mientras ayudan a Ben Miller, padre de Daniel y ex inspector del FBI, a reconstruir por última vez la desaparición de su hijo. Se adentrarán así en las profundidades de un enigma lleno de recovecos en los que resuenan las voces del pasado. ¿Qué le sucedió a Daniel? ¿Quién se esconde tras el horrible asesinato? ¿Puede el silencio ser el refugio de la verdad?', 'GrietaDelSilencio.jpg', 1),
(5, 'Alas de hierro (Empíreo 2)', 21, 26.9, 896, '2024-02-21', 'Novela de fantasía', 'Editorial Planeta', 'Todos esperaban que Violet Sorrengail muriera en su primer año en el Colegio de Guerra Basgiath, incluso ella misma. Pero la Trilla fue tan solo la primera de una serie de pruebas imposibles destinadas a deshacerse de los indignos y los desafortunados. Ahora comienza el verdadero entrenamiento, y Violet no sabe cómo logrará superarlo. No solo porque es brutal y agotador o porque está diseñado para llevar al límite el umbral del dolor de los jinetes, sino porque el nuevo vicecomandante está empeñado en demostrarle lo débil que es, a menos que traicione al hombre al que ama. La voluntad de sobrevivir no será suficiente porque Violet conoce el secreto que se oculta entre los muros del colegio, y nada, ni siquiera el fuego de dragón, será suficiente para salvarlos. Increíblemente peligrosa y adictiva, no te pierdas la continuación de Alas de sangre, el gran fenómeno internacional.', 'AlasHierro2.jpg', 1),
(6, 'Recupera tu mente, reconquista tu vida', 24, 20.9, 384, '2024-04-03', 'Autoayuda', 'Espasa', 'Cada vez estamos más impacientes e irritables y toleramos menos el dolor. ¿Notas que te cuesta más prestar atención? ¿Quién no ha sentido ansiedad en el último año? ¿Quién no tolera peor el aburrimiento y el dolor? ¿Notas que te cuesta más prestar atención? Vivimos en la era de la gratificación instantánea, en la cultura de la inmediatez y las recompensas, buscamos la felicidad a golpe de clic. Llevamos una vida agitada e intensa, y con el modo fast activado. Somos drogodependientes emocionales inundados de múltiples distracciones. Todo esto tiene un impacto en nuestra capacidad de prestar atención a lo importante, de profundizar y de concentrarnos. La buena noticia es que podemos rescatar la atención perdida, volver a reconectar con nosotros mismos y con todo lo maravilloso que nos rodea para encontrar ese equilibrio emocional que tanto ansiamos.', 'RecuperaTuMente.jpg', 1),
(7, 'Las hijas de la criada', 25, 14.95, 480, '2023-11-08', 'Novela Negra', 'Booket', 'Una noche de febrero de 1900, recien estrenado el siglo XX, en el pazo de Espíritu Santo llegan al mundo dos niñas, Clara y Catalina, cuyos destinos ya estaban escritos. Sin embargo, una venganza inesperada sacudirá para siempre sus vidas y las de todos los Valdes.Doña Ines, matriarca de la saga y fiel esposa de don Gustavo, deberá sobrevivir al desamor, al dolor del abandono y a las luchas de poder hasta convertir a su verdadera hija en heredera de todo un imperio, en una epoca en la que a las mujeres no se les permitía ser dueñas de sus vidas.', 'HijasCriada.jpg', 1),
(8, 'Cómo hacer que te pasen cosas buenas', 24, 20.9, 232, '2018-10-09', 'Autoayuda', 'Espasa', '¿Eres consciente de que tu manera de gestionar los conflictos te puede predisponer a sufrir ansiedad o depresión, las enfermedades más frecuentes del siglo XXI?Para la doctora Marian Rojas Estapé la felicidad consiste en vivir instalado de forma sana en el presente, habiendo superado las heridas del pasado y mirando con ilusión al futuro. Muchos de los trastornos que padecemos provienen de la incapacidad para gestionar nuestro presente. La felicidad no es lo que nos pasa, sino cómo interpretamos lo que nos pasa.En Cómo hacer que te pasen cosas buenas entenderás la importancia de aprender a enfocar tu atención y descubrirás pautas para combatir los miedos, las angustias y cómo canalizar las emociones negativas que te llegan a bloquear física y mentalmente', 'CosasBuenas.jpg', 1),
(9, 'El niño que perdió la guerra', 26, 24.9, 640, '2024-09-05', 'Novela contemporánea', 'Plaza&Janes', 'Madrid, invierno de 1938: Clotilde, una artista gráfica que dibuja caricaturas para los diarios republicanos, asiste en Madrid a los últimos meses de la Guerra Civil. La caída de la República es inminente, por lo que su marido, militante comunista que trabaja para los rusos, decide enviar a Moscú a su hijo Pablo, de tan solo cinco años, en contra de su voluntad. Clotilde se resiste con todas sus fuerzas, pero no logra evitar que el comandante Borís Petrov emprenda ese arriesgado viaje por una España en llamas para cumplir con el deseo de su camarada de llevar a Pablo a la Unión Soviética, donde Stalin está levantando un nuevo país sobre las ruinas del antiguo régimen.\nMoscú, primavera de 1939: Allí es recibido por su nueva familia que, conmovida por su trágico exilio, acoge con afecto a un niño exhausto y enfermo. Anya no duda en cuidar de Pablo como si fuese su propio hijo, sin hacer distinciones con Igor, su hermano de adopción. Hija y esposa de dos orgullosos héroes de la Revolución -su padre luchó junto a Lenin, su marido a las órdenes de Stalin-, Anya ama la poesía y la música, aficiones sospechosas y burguesas a los ojos del poder. Mientras sus ilusiones naufragan en el ambiente cada vez más opresivo del terror estalinista, su espíritu se rebela contra la injusticia, la miseria, la ausencia de libertad y el Gulag.', 'NiñoGuerra.jpg', 1),
(10, 'El señor de los anillos: la Comunidad del Anillo', 27, 19.95, 704, '1954-07-29', 'Novela de fantasía', 'Booket', 'La primera entrega de la trilogía de J. R. R. Tolkien El Señor de los Anillos. Empieza tu viaje a la Tierra Media. Edición revisada.\r\n\r\nUn héroe inesperado. Una misión peligrosa. La mayor aventura que jamás te hayan contado.\r\n\r\nEn la adormecida e idílica Comarca, un joven hobbit recibe un encargo: custodiar el Anillo Único y emprender el viaje para su destrucción en la Grieta del Destino. Acompañado por magos, hombres, elfos y enanos, atravesará la Tierra Media y se internará en las sombras de Mordor, perseguido siempre por las huestes de Sauron, el Señor Oscuro, dispuesto a recuperar su creación para establecer el dominio definitivo del Mal.', 'LOTR1.jpg', 1),
(11, 'La historia interminable', 28, 15.95, 400, '1979-01-01', 'Novela de fantasía', 'Alfaguara', 'La Emperatriz Infantil está mortalmente enferma y su reino, Fantasia, corre un grave peligro. La salvación depende de Atreyu, un valiente guerrero de la tribu de los pieles verdes, y Bastian, un niño tímido que lee con pasión un libro mágico. Solo un ser humano puede salvar este lugar encantado. Juntos emprenderán un fascinante viaje a traves de tierras de dragones, gigantes, monstruos y magia que no tiene vuelta atrás. A medida que se adentra en Fantasia, Bastian deberá resolver tambien los misterios de su propio corazón.', 'HistoriaInterminable.jpg', 1),
(12, 'Alas de Ónix (Empíreo 3)', 21, 23.9, 896, '2025-01-22', 'Novela de fantasía', 'Editorial Planeta', 'Tras casi dieciocho meses en el Colegio de Guerra Basgiath, Violet Sorrengail tiene claro que no queda tiempo para entrenar. Hay que tomar decisiones. La batalla ha comenzado y, con enemigos acercándose a las murallas e infiltrados en sus propias filas, es imposible saber en quién confiar.\r\n\r\nAhora Violet deberá emprender un viaje fuera de los límites de Aretia, en busca de aliados de tierras desconocidas que acepten pelear por Navarre. La misión pondrá a prueba su suerte, y la obligará a usar todo su ingenio y fortaleza para salvar lo que más ama: sus dragones, su familia, su hogar y a él.\r\n\r\nAunque eso signifique tener que guardar un secreto tan peligroso que podría destruirlo todo.\r\n\r\nNavarre necesita un ejército. Necesita poder. Necesita magia. Y necesitará algo que solo Violet puede encontrar: la verdad.\r\n\r\nPero una tormenta se aproxima… y no todos sobrevivirán a su furia.', 'AlasOnix3.jpg', 1),
(13, 'La Asistenta', 29, 19.9, 344, '2023-05-10', 'Thriller', 'Suma', 'Todos los días friego la preciosa casa de los Winchester de arriba abajo. Recojo a su hija del colegio y preparo deliciosas comidas para toda la familia antes de subir a cenar sola en mi minúscula habitación del piso superior.Intento no prestar atención a Nina cuando lo ensucia todo simplemente para ver cómo lo limpio. A las extrañas mentiras que cuenta sobre su propia hija. A su marido, que cada día parece más abatido. Pero cuando miro a Andrew a los ojos, castaños, encantadores y llenos de dolor, no me resulta difícil imaginar cómo sería vivir en la piel de Nina. El gran vestidor, el coche de lujo, el esposo perfecto.\r\n\r\nHasta que un día no me resisto a probarme uno de sus maravillosos vestidos blancos. Solo quiero saber que se siente. Pero ella pronto lo descubre, y cuando me doy cuenta de que la puerta de mi habitación solo se cierra por fuera ya es demasiado tarde.', 'Asistenta1.jpg', 1),
(14, 'El secreto de la Asistenta', 29, 20.9, 336, '2024-05-09', 'Thriller', 'Suma', 'Es difícil encontrar a alguien que te de trabajo sin preguntar demasiado sobre tu pasado. Así que le agradezco al universo que, milagrosamente, los Garrick me hayan dado empleo limpiando su impresionante ático con vistas a todo Manhattan y preparándoles comidas sofisticadas en su inmensa cocina. Puedo trabajar aquí durante un tiempo, ser discreta hasta conseguir lo que quiero.\r\n\r\nEs casi perfecto. Sin embargo, todavía no he conocido a la señora Garrick ni he podido ver lo que hay dentro de la habitación de invitados. Estoy segura de que la oigo llorar. Veo las pequeñas manchas de sangre en el cuello de sus camisones blancos cuando hago la colada. Y, un día, no puedo evitar llamar a su puerta. Cuando esta se abre lentamente, lo que veo lo cambia todo...\r\n\r\nEs entonces cuando hago una promesa. Douglas Garrick se ha equivocado. Y va a pagar. Es todo una cuestión de hasta dónde estoy dispuesta a llegar...', 'Asistenta2.jpg', 1),
(15, 'La Asistenta te vigila', 29, 20.9, 368, '2024-07-11', 'Thriller', 'Suma', 'Yo solía trabajar limpiando las casas de otras personas, ahora apenas puedo creerme que este sea mi hogar. La encantadora cocina, la calle tranquila, el enorme jardín en el que los niños pueden jugar. Mi marido y yo hemos ahorrado durante años para que mis hijos tengan la vida que se merecen.\r\n\r\nAunque siento algo de recelo hacia nuestra vecina, la señora Lowell, veo su invitación a cenar como una oportunidad para hacer amigos. Cuando su doncella abre la puerta con un delantal blanco y el pelo recogido en un moño tirante, se exactamente cómo se siente. Pero su gelida mirada me produce escalofríos...\r\n\r\nLa doncella de los Lowell no es lo único extraño de nuestra calle. Estoy convencida de que alguien nos observa. Y cuando conozco a la mujer que vive enfrente, sus palabras me dejan petrificada: \"Ten cuidado con tus vecinos\".\r\n\r\n¿Cometí un terrible error mudándome aquí con mi familia?', 'Asistenta3.jpg', 1),
(16, 'El señor de los anillos: las dos torres', 27, 19.95, 592, '1954-11-11', 'Novela de fantasía', 'Booket', 'La Compañía se ha disuelto y sus integrantes emprenden caminos separados. Frodo y Sam avanzan solos en su viaje a lo largo del río Anduin, perseguidos por la sombra misteriosa de un ser extraño que tambien ambiciona la posesión del Anillo. Mientras, hombres, elfos y enanos se preparan para la batalla final contra las fuerzas del Señor del Mal', 'LOTR2.jpg', 1),
(17, 'El señor de los anillos: el retorno del Rey', 27, 19.95, 688, '1955-10-20', 'Novela de fantasía', 'Booket', 'Los ejércitos del Señor Oscuro van extendiendo cada vez más su maléfica sombra por la Tierra Media. Hombres, elfos y enanos unen sus fuerzas para presentar batalla a Sauron y sus huestes. Ajenos a estos preparativos, Frodo y Sam siguen adentrándose en el país de Mordor en su heroico viaje para destruir el Anillo de Poder en las Grietas del Destino.', 'LOTR3.jpg', 1);

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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libro_id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('sRFKF5CCHci5RVMTStT3FKekJpaLRmuvA2R3fMhT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV093a0FkQTNSUWgzU2Jkb2kxd25HZExsdnRBVkxSU3ZCYWdsUTVvRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saWJyby8xMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746732193),
('xdCtJpqhUZjXRP4c06Mi9i9t7H7PU1onRUTRtGZs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDBrQUNnY0RpZ1VaZWJveVhUTDc5UVQxbkN2cFNyZGFKbk41TlRERSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saWJyby8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746879893),
('xXhqJEAYQYWEhG4XWTC6EAb1Pfiy1ThjIs5ZhCSr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW1zNVJQbnVrM0tycDA4ZXlobGFFSTI2dmp0aXJNSWFPRTRoMHRlUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saWJyby8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746733243);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(66) NOT NULL,
  `rol` varchar(6) NOT NULL DEFAULT 'user',
  `esActivo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `esActivo`) VALUES
(1, 'admin1', 'admin1@gmail.com', 'admin1234', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`) USING BTREE;

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`,`id_autor`) USING BTREE,
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indices de la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD PRIMARY KEY (`id_libro`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_libro_id_foreign` (`libro_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`nombre`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);

--
-- Filtros para la tabla `libros_categorias`
--
ALTER TABLE `libros_categorias`
  ADD CONSTRAINT `libros_categorias_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `libros_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_libro_id_foreign` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
