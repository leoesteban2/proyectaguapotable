-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2024 a las 21:46:19
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
-- Base de datos: `db_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro_base`
--

CREATE TABLE `cobro_base` (
  `idcobro_base` bigint(20) NOT NULL,
  `idusuario_contador` bigint(20) NOT NULL,
  `fecha_cobro` date DEFAULT current_timestamp(),
  `monto_base` float NOT NULL,
  `estado_cobro` enum('pendiente','pagado','cancelado') DEFAULT 'pendiente',
  `tipo_cobro` enum('mensual','anual','unico') DEFAULT 'mensual',
  `detalle` varchar(255) DEFAULT 'Cobro base por servicio',
  `idtarifa` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cobro_base`
--

INSERT INTO `cobro_base` (`idcobro_base`, `idusuario_contador`, `fecha_cobro`, `monto_base`, `estado_cobro`, `tipo_cobro`, `detalle`, `idtarifa`) VALUES
(25, 17, '2024-10-01', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(27, 21, '2024-10-01', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(28, 16, '2024-10-01', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(29, 18, '2024-10-01', 30, 'pagado', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(30, 20, '2024-10-01', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(31, 22, '2024-10-01', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(32, 10, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(33, 17, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(34, 19, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(35, 21, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(36, 16, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(37, 18, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(38, 20, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(39, 22, '2024-10-01', 5, 'pendiente', 'mensual', 'Cobro solo por exceso mayor', 3),
(40, 10, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(41, 17, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(42, 19, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(43, 21, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(44, 16, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(45, 18, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(46, 20, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(47, 22, '2024-10-16', 1, 'pendiente', 'unico', 'PAGO PARA NUEVO POSTE', NULL),
(48, 10, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(49, 17, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(50, 19, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(51, 21, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(52, 16, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(53, 18, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(54, 20, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(55, 22, '2024-10-17', 30, 'pendiente', 'unico', 'COBRO CONSTRUCCION PILA', NULL),
(56, 10, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(57, 17, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(58, 19, '2024-10-01', 2, 'pagado', 'unico', 'Cobro solo por exceso menor', 2),
(59, 21, '2024-10-01', 2, 'pagado', 'unico', 'Cobro solo por exceso menor', 2),
(60, 16, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(61, 18, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(62, 20, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(63, 22, '2024-10-01', 2, 'pendiente', 'unico', 'Cobro solo por exceso menor', 2),
(64, 26, '2024-10-19', 5, 'pendiente', 'unico', 'Construccion de pila', 11),
(65, 27, '2024-10-31', 5, 'pagado', 'unico', 'Construccion de pila', 11);

--
-- Disparadores `cobro_base`
--
DELIMITER $$
CREATE TRIGGER `registrar_cobro_base` AFTER INSERT ON `cobro_base` FOR EACH ROW BEGIN
    -- Obtener el total de abonos (pagos) que ha hecho el usuario
    SET @abonos_totales = (SELECT COALESCE(SUM(abono), 0) FROM estado_cuenta WHERE idusuario_contador = NEW.idusuario_contador);

    -- Obtener el total de cargos (cobros) que ha recibido el usuario
    SET @cargos_totales = (SELECT COALESCE(SUM(cargo), 0) FROM estado_cuenta WHERE idusuario_contador = NEW.idusuario_contador);

    -- Calcular el saldo correcto: cargos - abonos
    SET @saldo_actual = @cargos_totales - @abonos_totales;

    -- Si no hay saldo previo (esto se maneja al calcular cargos y abonos), el saldo actual es 0
    IF @saldo_actual IS NULL THEN
        SET @saldo_actual = 0;
    END IF;

    -- Insertar el nuevo cargo en el estado de cuenta y actualizar el saldo
    INSERT INTO estado_cuenta (idusuario_contador, fecha, detalle, cargo, saldo, id_documento_origen)
    VALUES (NEW.idusuario_contador, NOW(), NEW.detalle, NEW.monto_base, @saldo_actual + NEW.monto_base, NEW.idcobro_base);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro_servicio`
--

CREATE TABLE `cobro_servicio` (
  `idcobro` bigint(20) NOT NULL,
  `idlectura` bigint(20) DEFAULT NULL,
  `fecha_cobro` date DEFAULT current_timestamp(),
  `exceso_menor` float DEFAULT NULL,
  `exceso_mayor` float DEFAULT NULL,
  `total_a_pagar` float DEFAULT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  `estado_cobro` enum('pendiente','pagado','cancelado','') NOT NULL DEFAULT 'pendiente',
  `tipo_cobro` enum('exceso') DEFAULT 'exceso',
  `idusuario_contador` bigint(20) DEFAULT NULL,
  `total_exceso` float GENERATED ALWAYS AS (`exceso_menor` + `exceso_mayor`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cobro_servicio`
--

INSERT INTO `cobro_servicio` (`idcobro`, `idlectura`, `fecha_cobro`, `exceso_menor`, `exceso_mayor`, `total_a_pagar`, `detalle`, `estado_cobro`, `tipo_cobro`, `idusuario_contador`) VALUES
(3, 1, '2024-10-12', 8, 2, 26, 'Cobro por exceso menor de 8 m³ y mayor de 2 m³', 'pendiente', 'exceso', 17),
(4, 2, '2024-10-12', 8, 2, 26, 'Cobro por exceso menor de 8 m³ y mayor de 2 m³', 'pagado', 'exceso', 21),
(5, 3, '2024-10-12', 8, 0, 16, 'Cobro por exceso menor de 8 m³', 'pendiente', 'exceso', 16),
(6, 8, '2024-10-13', 8, 22, 126, 'Cobro por exceso menor de 8 m³ y mayor de 22 m³', 'pagado', 'exceso', 18),
(7, 9, '2024-10-13', 5, 0, 10, 'Cobro por exceso menor de 5 m³', 'pagado', 'exceso', 21),
(8, 10, '2024-10-15', 8, 2, 26, 'Exceso menor de 8 m³ y mayor de 2 m³', 'pendiente', 'exceso', 17),
(9, 11, '2024-10-17', 8, 2, 26, 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 'pagado', 'exceso', 18),
(10, 12, '2024-10-17', 8, 12, 76, 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 'pagado', 'exceso', 22),
(12, 15, '2024-10-18', 8, 52, 276, 'Exceso menor de 8 m³ y mayor de 52 m³ del mes de octubre 2024', 'pagado', 'exceso', 23),
(13, 16, '2024-10-18', 8, 2, 26, 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 'pagado', 'exceso', 23),
(14, 18, '2024-10-18', 8, 2, 26, 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 'pagado', 'exceso', 25),
(15, 19, '2024-10-18', 8, 12, 76, 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 'pendiente', 'exceso', 25),
(16, 20, '2024-10-18', 8, 12, 76, 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 'pendiente', 'exceso', 25),
(17, 21, '2024-10-19', 5, 0, 10, 'Exceso menor de 5 m³ del mes de octubre 2024', 'pagado', 'exceso', 26),
(18, 22, '2024-10-19', 5, 0, 10, 'Exceso menor de 5 m³ del mes de octubre 2024', 'pagado', 'exceso', 27);

--
-- Disparadores `cobro_servicio`
--
DELIMITER $$
CREATE TRIGGER `registrar_cobro_servicio` AFTER INSERT ON `cobro_servicio` FOR EACH ROW BEGIN
    -- Obtener el total de abonos (pagos) que ha hecho el usuario
    SET @abonos_totales = (SELECT COALESCE(SUM(abono), 0) 
                           FROM estado_cuenta 
                           WHERE idusuario_contador = NEW.idusuario_contador);

    -- Obtener el total de cargos (cobros) que ha recibido el usuario
    SET @cargos_totales = (SELECT COALESCE(SUM(cargo), 0) 
                           FROM estado_cuenta 
                           WHERE idusuario_contador = NEW.idusuario_contador);

    -- Calcular el saldo correcto: cargos - abonos
    SET @saldo_actual = @cargos_totales - @abonos_totales;

    -- Insertar el nuevo cobro como cargo en el estado de cuenta y actualizar el saldo
    INSERT INTO estado_cuenta (
        idusuario_contador, 
        fecha, 
        detalle, 
        cargo, 
        abono, 
        saldo, 
        id_documento_origen
    ) VALUES (
        NEW.idusuario_contador, 
        NOW(), 
        NEW.detalle, 
        NEW.total_a_pagar,  -- Cargo
        0,                  -- No hay abono
        @saldo_actual + NEW.total_a_pagar,  -- Actualizar el saldo correctamente
        NEW.idcobro
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

CREATE TABLE `contador` (
  `idcontador` bigint(20) NOT NULL,
  `no_contador` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_instalacion` date DEFAULT NULL,
  `ultimo_mantenimiento` date DEFAULT NULL,
  `lectura_actual` int(25) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','MANTENIMIENTO','RETIRADO','CANDELA') DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`idcontador`, `no_contador`, `descripcion`, `fecha_instalacion`, `ultimo_mantenimiento`, `lectura_actual`, `estado`) VALUES
(1, '1815011385f4', 'CONTADOR ATRAS DEL OSASIS', '2024-10-03', '2024-10-01', 0, 'ACTIVO'),
(2, '1264565678', 'Contador barrio central', '2024-10-01', '2024-10-01', 50, 'ACTIVO'),
(3, '1815011385', 'Contador barrio central', '2024-10-01', '2024-10-01', 80, 'ACTIVO'),
(5, '1264565678', 'Contador barrio central', '2024-10-02', '2024-10-02', 160, 'CANDELA'),
(7, '1815013287G', 'ATRAS DEL OASIS', '2024-10-01', '2024-10-01', 302, 'ACTIVO'),
(8, '7896789678', 'Contador barrio central', '2024-10-02', '2024-10-02', 170, 'ACTIVO'),
(9, '454664C45', 'barrio central', '2024-10-01', '2024-10-01', 45, 'ACTIVO'),
(10, '664444848', 'Contador barrio central', '2024-10-01', '2024-10-01', 45, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cuenta`
--

CREATE TABLE `estado_cuenta` (
  `idestado_cuenta` bigint(20) NOT NULL,
  `idusuario_contador` bigint(20) NOT NULL,
  `fecha` date DEFAULT current_timestamp(),
  `detalle` varchar(255) DEFAULT NULL,
  `cargo` float DEFAULT 0,
  `abono` float DEFAULT 0,
  `saldo` float NOT NULL,
  `id_documento_origen` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_cuenta`
--

INSERT INTO `estado_cuenta` (`idestado_cuenta`, `idusuario_contador`, `fecha`, `detalle`, `cargo`, `abono`, `saldo`, `id_documento_origen`) VALUES
(1, 21, '2024-10-15', 'Pago por exceso mensual', 0, 10, -10, 1),
(2, 18, '2024-10-15', 'Pago por exceso mes - October 2024', 0, 126, -126, 2),
(3, 17, '2024-10-15', 'Exceso menor de 8 m³ y mayor de 2 m³', 26, 0, 26, 8),
(4, 10, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 1, 40),
(5, 17, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 27, 41),
(6, 19, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 1, 42),
(7, 21, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, -9, 43),
(8, 16, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 1, 44),
(9, 18, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, -125, 45),
(10, 20, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 1, 46),
(11, 22, '2024-10-16', 'PAGO PARA NUEVO POSTE', 1, 0, 1, 47),
(12, 10, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 31, 48),
(13, 17, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 57, 49),
(14, 19, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 31, 50),
(15, 21, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 21, 51),
(16, 16, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 31, 52),
(17, 18, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, -95, 53),
(18, 20, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 31, 54),
(19, 22, '2024-10-16', 'COBRO CONSTRUCCION PILA', 30, 0, 31, 55),
(20, 10, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 3, 56),
(21, 17, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 59, 57),
(22, 19, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 3, 58),
(23, 21, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 23, 59),
(24, 16, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 3, 60),
(25, 18, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, -93, 61),
(26, 20, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 3, 62),
(27, 22, '2024-10-16', 'Cobro solo por exceso menor', 2, 0, 3, 63),
(28, 18, '2024-10-17', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 0, -67, 9),
(29, 18, '2024-10-17', 'PRUEGA PAGO DJALÑFSKJD', 0, 26, -93, 3),
(30, 18, '2024-10-17', 'Pago por exceso mes - octubre 2024', 0, 26, -93, 7),
(31, 18, '2024-10-17', NULL, 0, 30, -97, 8),
(32, 19, '2024-10-17', NULL, 0, 30, -27, 9),
(33, 22, '2024-10-17', 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 76, 0, 79, 10),
(34, 22, '2024-10-17', 'Pago por exceso mes - octubre 2024', 0, 76, 3, 10),
(35, 21, '2024-10-17', NULL, 0, 2, 21, 11),
(36, 21, '2024-10-17', 'Pago por exceso mes - octubre 2024', 0, 26, -5, 12),
(37, 19, '2024-10-17', NULL, 0, 2, -29, 13),
(38, 22, '2024-10-17', 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 76, 0, 155, 11),
(39, 22, '2024-10-17', 'Pago por exceso mes - octubre 2024', 0, 76, 3, 14),
(40, 23, '2024-10-18', 'Exceso menor de 8 m³ y mayor de 52 m³ del mes de octubre 2024', 276, 0, 276, 12),
(41, 23, '2024-10-18', 'Pago por exceso mes - octubre 2024', 0, 276, 0, 15),
(42, 23, '2024-10-18', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 0, 302, 13),
(43, 23, '2024-10-18', 'Pago por exceso mes - octubre 2024', 0, 26, 276, 16),
(44, 25, '2024-10-18', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 0, 26, 14),
(45, 25, '2024-10-18', 'Pago por exceso mes - octubre 2024', 0, 26, 0, 17),
(47, 25, '2024-10-18', 'Exceso menor de 8 m³ y mayor de 12 m³ del mes de octubre 2024', 76, 0, 102, 16),
(48, 26, '2024-10-19', 'Exceso menor de 5 m³ del mes de octubre 2024', 10, 0, 10, 17),
(49, 26, '2024-10-19', 'Pago por exceso mes - octubre 2024', 0, 10, 0, 18),
(50, 26, '2024-10-19', 'Construccion de pila', 5, 0, 15, 64),
(51, 27, '2024-10-19', 'Exceso menor de 5 m³ del mes de octubre 2024', 10, 0, 10, 18),
(52, 27, '2024-10-19', 'Pago por exceso mes - octubre 2024', 0, 10, 0, 19),
(53, 27, '2024-10-19', 'Construccion de pila', 5, 0, 5, 65),
(54, 27, '2024-10-19', 'Pago por exceso mes - octubre 2024', 0, 5, 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectura`
--

CREATE TABLE `lectura` (
  `idlectura` bigint(20) NOT NULL,
  `idusuario_contador` bigint(20) NOT NULL,
  `fecha_lectura` date NOT NULL,
  `lectura_actual` float NOT NULL,
  `lectura_anterior` float DEFAULT NULL,
  `consumo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lectura`
--

INSERT INTO `lectura` (`idlectura`, `idusuario_contador`, `fecha_lectura`, `lectura_actual`, `lectura_anterior`, `consumo`) VALUES
(1, 17, '2024-10-12', 50, 0, 50),
(2, 21, '2024-10-13', 100, 50, 50),
(3, 16, '2024-10-31', 48, 0, 48),
(4, 19, '2024-10-13', 140, 100, 40),
(6, 18, '2024-10-13', 80, 40, 40),
(7, 22, '2024-10-13', 37, 0, 37),
(8, 18, '2024-10-14', 150, 80, 70),
(9, 21, '2024-10-20', 185, 140, 45),
(10, 17, '2024-10-01', 50, 0, 50),
(11, 18, '2024-10-31', 50, 0, 50),
(12, 22, '2024-10-01', 60, 0, 60),
(13, 18, '2024-10-30', 80, 50, 30),
(15, 23, '2024-10-31', 252, 152, 100),
(16, 23, '2024-11-29', 302, 252, 50),
(17, 24, '2024-10-01', 160, 120, 40),
(18, 25, '2024-10-01', 50, 0, 50),
(19, 25, '2024-10-01', 110, 50, 60),
(20, 25, '2024-10-31', 170, 110, 60),
(21, 26, '2024-10-31', 45, 0, 45),
(22, 27, '2024-10-31', 45, 0, 45);

--
-- Disparadores `lectura`
--
DELIMITER $$
CREATE TRIGGER `actualizar_lectura_contador` AFTER INSERT ON `lectura` FOR EACH ROW BEGIN
    UPDATE contador
    SET lectura_actual = NEW.lectura_actual
    WHERE idcontador = (SELECT idcontador FROM usuario_contador WHERE idusuario_contador = NEW.idusuario_contador);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_consumo` BEFORE INSERT ON `lectura` FOR EACH ROW BEGIN
    -- Si no hay lectura anterior, el consumo se establece en NULL
    IF NEW.lectura_anterior IS NULL THEN
        SET NEW.consumo = NULL;
    ELSE
        -- Calcula el consumo como la diferencia entre lectura actual y anterior
        SET NEW.consumo = NEW.lectura_actual - NEW.lectura_anterior;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generar_cobro_automatico_v2` AFTER INSERT ON `lectura` FOR EACH ROW BEGIN
    DECLARE consumo FLOAT;
    DECLARE exceso_menor FLOAT;
    DECLARE exceso_mayor FLOAT;
    DECLARE tarifa_exceso_menor FLOAT DEFAULT 2;  -- Valor predeterminado
    DECLARE tarifa_exceso_mayor FLOAT DEFAULT 5;  -- Valor predeterminado
    DECLARE total_a_pagar FLOAT;
    DECLARE detalle VARCHAR(255);
    DECLARE mes_cobro VARCHAR(50);  -- Para almacenar el mes y el año del cobro

    -- Inicializar las variables de exceso
    SET exceso_menor = 0;
    SET exceso_mayor = 0;

    -- Obtener el consumo recién insertado
    SET consumo = NEW.consumo;

    -- Obtener las tarifas de exceso menor y mayor de la tabla `tarifa`
    SELECT tarifa_metro_cubico INTO tarifa_exceso_menor
    FROM tarifa
    WHERE rango_consumo_min = 40 AND rango_consumo_max = 48
    LIMIT 1;

    IF tarifa_exceso_menor IS NULL THEN
        SET tarifa_exceso_menor = 2;
    END IF;

    SELECT tarifa_metro_cubico INTO tarifa_exceso_mayor
    FROM tarifa
    WHERE rango_consumo_min > 48
    LIMIT 1;

    IF tarifa_exceso_mayor IS NULL THEN
        SET tarifa_exceso_mayor = 5;
    END IF;

    -- Determinar el exceso según la tarifa
    IF consumo > 40 THEN
        -- Calcular exceso menor (entre 40 y 48 m³)
        IF consumo <= 48 THEN
            SET exceso_menor = consumo - 40;
        ELSE
            -- Si es mayor a 48, calcular ambos excesos
            SET exceso_menor = 8;  -- Exceso máximo permitido para el rango de 40 a 48
            SET exceso_mayor = consumo - 48;
        END IF;
    END IF;

    -- Calcular el total a pagar sin la tarifa base
    SET total_a_pagar = (exceso_menor * tarifa_exceso_menor) + (exceso_mayor * tarifa_exceso_mayor);

    -- Obtener el mes y el año en español
    SET lc_time_names = 'es_ES';  -- Establecer idioma para los nombres de meses en español
    SET mes_cobro = DATE_FORMAT(NOW(), '%M %Y');  -- Obtener el mes y año actual (modificar si se quiere usar otro campo de fecha)

    -- Generar el detalle del cobro con el mes y año
    IF exceso_menor > 0 AND exceso_mayor = 0 THEN
        SET detalle = CONCAT('Exceso menor de ', exceso_menor, ' m³ del mes de ', mes_cobro);
    ELSEIF exceso_menor = 0 AND exceso_mayor > 0 THEN
        SET detalle = CONCAT('Exceso mayor de ', exceso_mayor, ' m³ del mes de ', mes_cobro);
    ELSEIF exceso_menor > 0 AND exceso_mayor > 0 THEN
        SET detalle = CONCAT('Exceso menor de ', exceso_menor, ' m³ y mayor de ', exceso_mayor, ' m³ del mes de ', mes_cobro);
    ELSE
        SET detalle = 'No hay exceso en el consumo';
    END IF;

    -- Insertar el cobro en la tabla cobro_servicio solo si hay exceso
    IF exceso_menor > 0 OR exceso_mayor > 0 THEN
        INSERT INTO `cobro_servicio` (
            idlectura, 
            fecha_cobro, 
            exceso_menor, 
            exceso_mayor, 
            total_a_pagar, 
            detalle, 
            estado_cobro, 
            tipo_cobro, 
            idusuario_contador
        ) VALUES (
            NEW.idlectura, 
            NOW(), 
            exceso_menor, 
            exceso_mayor, 
            total_a_pagar, 
            detalle, 
            'pendiente', 
            'exceso', 
            NEW.idusuario_contador
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_servicio`
--

CREATE TABLE `pago_servicio` (
  `idpago` bigint(20) NOT NULL,
  `idcobro` bigint(20) DEFAULT NULL,
  `idcobro_base` bigint(20) DEFAULT NULL,
  `idusuario_contador` bigint(20) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `detalle` text NOT NULL,
  `monto_pagado` float DEFAULT NULL,
  `tipo_pago` enum('mensual','anual','unico') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_servicio`
--

INSERT INTO `pago_servicio` (`idpago`, `idcobro`, `idcobro_base`, `idusuario_contador`, `fecha_pago`, `detalle`, `monto_pagado`, `tipo_pago`) VALUES
(2, 6, NULL, 18, '2024-10-01', 'PAGO POR EXCESO MES ', 126, 'mensual'),
(3, NULL, NULL, 18, '2024-10-01', 'PAGO SERVICIOS PRUEABA\r\n', 26, 'mensual'),
(7, 9, NULL, 18, '2024-10-01', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 'mensual'),
(8, NULL, 29, 18, '2024-10-02', 'COBRO CONSTRUCCION PILA', 30, 'unico'),
(12, 4, NULL, 21, '2024-10-01', 'Cobro por exceso menor de 8 m³ y mayor de 2 m³', 26, 'mensual'),
(13, NULL, 58, 19, '2024-10-01', 'Cobro solo por exceso menor', 2, 'mensual'),
(15, 12, NULL, 23, '2024-10-01', 'Exceso menor de 8 m³ y mayor de 52 m³ del mes de octubre 2024', 276, 'mensual'),
(16, 13, NULL, 23, '2024-10-01', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 'mensual'),
(17, 14, NULL, 25, '2024-10-01', 'Exceso menor de 8 m³ y mayor de 2 m³ del mes de octubre 2024', 26, 'mensual'),
(18, 17, NULL, 26, '2024-10-20', 'Exceso menor de 5 m³ del mes de octubre 2024', 10, 'mensual'),
(19, 18, NULL, 27, '2024-11-01', 'Exceso menor de 5 m³ del mes de octubre 2024', 10, 'mensual'),
(20, NULL, 65, 27, '2024-11-02', 'Construccion de pila', 5, 'unico');

--
-- Disparadores `pago_servicio`
--
DELIMITER $$
CREATE TRIGGER `actualizar_estado_cobro` AFTER INSERT ON `pago_servicio` FOR EACH ROW BEGIN
    -- Actualizar cobro_servicio si es un pago de exceso
    IF NEW.idcobro IS NOT NULL THEN
        UPDATE cobro_servicio
        SET estado_cobro = 'pagado'
        WHERE idcobro = NEW.idcobro;
    END IF;

    -- Actualizar cobro_base si es un pago de cobro base
    IF NEW.idcobro_base IS NOT NULL THEN
        UPDATE cobro_base
        SET estado_cobro = 'pagado'
        WHERE idcobro_base = NEW.idcobro_base;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registrar_pago_servicio` AFTER INSERT ON `pago_servicio` FOR EACH ROW BEGIN
    -- Establecer el idioma para los nombres de los meses en español
    SET lc_time_names = 'es_ES';

    -- Obtener el último saldo del estado de cuenta para este usuario
    SET @saldo_actual = (SELECT saldo FROM estado_cuenta 
                         WHERE idusuario_contador = NEW.idusuario_contador 
                         ORDER BY fecha DESC LIMIT 1);

    -- Si no hay saldo previo, se inicializa en 0
    IF @saldo_actual IS NULL THEN
        SET @saldo_actual = 0;
    END IF;

    -- Registrar el abono (pago) y restar del saldo
    INSERT INTO estado_cuenta (
        idusuario_contador, 
        fecha, 
        detalle, 
        cargo, 
        abono, 
        saldo, 
        id_documento_origen
    ) VALUES (
        NEW.idusuario_contador, 
        NOW(), 
        CONCAT('Pago por exceso mes - ', DATE_FORMAT(NOW(), '%M %Y')),  -- Detalle del pago
        0,                       -- No hay cargo
        NEW.monto_pagado,        -- Abono
        @saldo_actual - NEW.monto_pagado,  -- Restar el monto pagado del saldo actual
        NEW.idpago               -- ID del documento origen (pago)
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `idtarifa` bigint(20) NOT NULL,
  `descripcion` text NOT NULL,
  `rango_consumo_min` float DEFAULT NULL,
  `rango_consumo_max` float DEFAULT NULL,
  `tarifa_metro_cubico` float DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idtarifa`, `descripcion`, `rango_consumo_min`, `rango_consumo_max`, `tarifa_metro_cubico`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Tarifa base', 0, 40, 20, '2024-10-01', '2024-10-31'),
(2, 'Cobro solo por exceso menor', 40, 48, 2, '2024-10-01', '2024-10-31'),
(3, 'Cobro solo por exceso mayor', 48, 100, 5, '2024-10-01', '2024-10-30'),
(11, 'Construccion de pila', 0, 0, 5, '2024-10-01', '2024-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo_propiedad`
--

CREATE TABLE `titulo_propiedad` (
  `idtitulo` bigint(20) NOT NULL,
  `idusuario_contador` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `no_titulo` int(11) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `titulo_propiedad`
--

INSERT INTO `titulo_propiedad` (`idtitulo`, `idusuario_contador`, `fecha`, `no_titulo`, `estado`) VALUES
(2, 10, '2024-10-01', 22, 'ACTIVO'),
(9, 17, '2024-10-04', 54, 'ACTIVO'),
(10, 18, '2024-10-04', NULL, 'ACTIVO'),
(11, 19, '2024-10-01', 152, 'ACTIVO'),
(12, 20, '2024-10-05', 8, 'ACTIVO'),
(14, 22, '2024-10-20', 78, 'ACTIVO'),
(15, 23, '2024-10-01', NULL, 'ACTIVO'),
(16, 24, '2024-10-01', NULL, 'ACTIVO'),
(17, 25, '2024-10-01', NULL, 'ACTIVO'),
(18, 26, '2018-01-01', 78, 'ACTIVO'),
(19, 27, '2024-10-20', NULL, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `no_orden` int(8) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `dpi` varchar(30) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `ultima_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `no_orden`, `nombres`, `apellidos`, `telefono`, `dpi`, `direccion`, `estado`, `fecha_creacion`, `ultima_actualizacion`) VALUES
(3, 22, 'Leonardo', 'Esteban', '53559933', '3356677442442', 'Barrio la libertad', 'ACTIVO', '2024-09-30 18:36:06', '2024-10-13 10:53:42'),
(4, 48, 'PAULA MARIBEL', 'MOTA GAMEZ', '58880126', '3356677442442', 'Barrio la libertad', 'ACTIVO', '2024-09-30 18:45:15', '2024-09-30 18:45:15'),
(5, 456, 'LEONARDO ESTEBAN', 'ORTIZ', '5687968767', '4657687987987', 'BARRIO LA LIBERTDAD', 'ACTIVO', '2024-09-30 18:52:30', '2024-09-30 18:52:30'),
(8, 88, 'PABLO', 'RA', '4654684796', '4684684684646', 'BARRIO', 'ACTIVO', '2024-10-02 22:39:38', '2024-10-02 22:39:38'),
(9, 98, 'LEONARDO', 'ESTEBAN', '53559933', '2224667814121', 'BARRIO LA LIBERTAD', 'ACTIVO', '2024-10-02 22:39:50', '2024-10-02 22:39:50'),
(10, 74, 'LUIS', 'ESTEBAN', '468468468', '1616461468496', 'BARRIO LA LIBERTAD', 'ACTIVO', '2024-10-02 22:40:29', '2024-10-02 22:40:29'),
(11, 24, 'ROR', 'PAL', '4646845456', '4684681461846', 'BARRIO', 'ACTIVO', '2024-10-02 22:50:01', '2024-10-02 22:50:01'),
(12, 1, 'MIRIAM FLORIDALMA ', 'CASTRO LARIOS', '49716004', '3356677442442', 'JOYABAJ', 'ACTIVO', '2024-10-18 15:25:45', '2024-10-18 15:25:45'),
(13, 884, 'LEONARDO', 'ESTEBAN', '53559933', '2224667814121', 'BARRIO LA LIBERTAD', 'ACTIVO', '2024-10-18 18:50:06', '2024-10-18 18:50:06'),
(14, 78, 'JUAN', 'RONALDO', '1234568745', '1155648441412', 'JOYABAJ', 'ACTIVO', '2024-10-19 13:17:17', '2024-10-19 13:17:17'),
(15, 66, 'PEDRO', 'PEDRO', '0151651615', '1543543135135', 'JOYABA', 'ACTIVO', '2024-10-19 13:42:03', '2024-10-19 13:42:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_contador`
--

CREATE TABLE `usuario_contador` (
  `idusuario_contador` bigint(20) NOT NULL,
  `idusuario` bigint(20) DEFAULT NULL,
  `idcontador` bigint(20) DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_contador`
--

INSERT INTO `usuario_contador` (`idusuario_contador`, `idusuario`, `idcontador`, `fecha_asignacion`) VALUES
(10, 4, 2, '2024-10-05'),
(16, 8, 3, '2024-10-04'),
(17, 5, 2, '2024-10-04'),
(18, 10, 3, '2024-10-04'),
(19, 5, 2, '2024-10-01'),
(20, 4, 5, '2024-10-05'),
(21, 4, 2, '2024-10-06'),
(22, 11, 5, '2024-10-20'),
(23, 12, 7, '2024-10-01'),
(24, 12, 5, '2024-10-01'),
(25, 13, 8, '2024-10-01'),
(26, 14, 9, '2024-10-19'),
(27, 15, 10, '2024-10-20');

--
-- Disparadores `usuario_contador`
--
DELIMITER $$
CREATE TRIGGER `after_delete_usuario_contador` AFTER DELETE ON `usuario_contador` FOR EACH ROW BEGIN
    INSERT INTO usuario_contador_historial (
        idusuario,
        idcontador,
        fecha_asignacion,
        fecha_desasignacion,
        estado
    )
    VALUES (
        OLD.idusuario,
        OLD.idcontador,
        OLD.fecha_asignacion,
        NOW(),
        'RETIRADO'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_usuario_contador` AFTER INSERT ON `usuario_contador` FOR EACH ROW BEGIN
    INSERT INTO usuario_contador_historial (
        idusuario,
        idcontador,
        fecha_asignacion,
        estado
    )
    VALUES (
        NEW.idusuario,
        NEW.idcontador,
        NEW.fecha_asignacion,
        'ASIGNADO'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_usuario_contador` AFTER UPDATE ON `usuario_contador` FOR EACH ROW BEGIN
    INSERT INTO usuario_contador_historial (
        idusuario,
        idcontador,
        fecha_asignacion,
        fecha_cambio,
        estado
    )
    VALUES (
        NEW.idusuario,
        NEW.idcontador,
        NEW.fecha_asignacion,
        NOW(),
        'ACTUALIZADO'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `despues_insert_usuario_contador` AFTER INSERT ON `usuario_contador` FOR EACH ROW BEGIN
    INSERT INTO titulo_propiedad (
        idusuario_contador,
        fecha,
        estado
    )
    VALUES (
        NEW.idusuario_contador,
        NEW.fecha_asignacion,
        'ACTIVO'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_contador_historial`
--

CREATE TABLE `usuario_contador_historial` (
  `idusuario_contador_historial` bigint(20) NOT NULL,
  `idusuario` bigint(20) DEFAULT NULL,
  `idcontador` bigint(20) DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `fecha_cambio` date DEFAULT NULL,
  `fecha_desasignacion` date DEFAULT NULL,
  `estado` enum('ASIGNADO','ACTUALIZADO','RETIRADO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_contador_historial`
--

INSERT INTO `usuario_contador_historial` (`idusuario_contador_historial`, `idusuario`, `idcontador`, `fecha_asignacion`, `fecha_cambio`, `fecha_desasignacion`, `estado`) VALUES
(9, 4, 1, '2024-10-03', '2024-10-02', NULL, 'ACTUALIZADO'),
(10, 4, 1, '2024-10-03', NULL, '2024-10-02', 'RETIRADO'),
(11, 5, 5, '2024-10-02', NULL, NULL, 'ASIGNADO'),
(12, 8, 1, '2024-10-03', NULL, NULL, 'ASIGNADO'),
(13, 4, 1, NULL, NULL, NULL, 'ASIGNADO'),
(14, 4, 1, NULL, NULL, NULL, 'ASIGNADO'),
(15, 4, 1, NULL, NULL, NULL, 'ASIGNADO'),
(16, 4, 1, '2024-10-03', NULL, NULL, 'ASIGNADO'),
(17, 11, 3, '2024-10-03', NULL, NULL, 'ASIGNADO'),
(18, 4, 1, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(19, 4, 2, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(20, 4, 1, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(21, 4, 1, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(22, 3, 2, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(23, 11, 3, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(24, 3, 1, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(25, 5, 2, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(26, 11, 3, '2024-10-03', NULL, '2024-10-03', 'RETIRADO'),
(27, 11, 3, '2024-10-04', NULL, '2024-10-03', 'RETIRADO'),
(28, 3, 2, '2024-10-04', NULL, '2024-10-03', 'RETIRADO'),
(29, 8, 5, '2024-10-03', NULL, NULL, 'ASIGNADO'),
(34, 8, 5, '2024-10-03', NULL, '2024-10-03', 'RETIRADO'),
(35, 3, 3, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(44, 3, 3, '2024-10-03', NULL, '2024-10-03', 'RETIRADO'),
(51, 4, 2, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(52, 5, 2, '2024-10-03', '2024-10-03', NULL, 'ACTUALIZADO'),
(53, 4, 1, '2024-10-04', '2024-10-03', NULL, 'ACTUALIZADO'),
(54, 4, 2, '2024-10-05', '2024-10-03', NULL, 'ACTUALIZADO'),
(55, 3, 2, '2024-10-05', '2024-10-03', NULL, 'ACTUALIZADO'),
(56, 8, 3, '2024-10-04', NULL, NULL, 'ASIGNADO'),
(57, 5, 2, '2024-10-03', NULL, '2024-10-04', 'RETIRADO'),
(58, 3, 2, '2024-10-05', NULL, '2024-10-04', 'RETIRADO'),
(59, 4, 2, '2024-10-04', NULL, NULL, 'ASIGNADO'),
(60, 5, 2, '2024-10-04', '2024-10-04', NULL, 'ACTUALIZADO'),
(61, 10, 3, '2024-10-04', NULL, NULL, 'ASIGNADO'),
(62, 5, 2, '2024-10-01', NULL, NULL, 'ASIGNADO'),
(63, 5, 3, '2024-10-05', NULL, NULL, 'ASIGNADO'),
(64, 4, 2, '2024-10-06', NULL, NULL, 'ASIGNADO'),
(65, 4, 5, '2024-10-05', '2024-10-11', NULL, 'ACTUALIZADO'),
(66, 11, 5, '2024-10-20', NULL, NULL, 'ASIGNADO'),
(67, 12, 7, '2024-10-01', NULL, NULL, 'ASIGNADO'),
(68, 12, 5, '2024-10-01', NULL, NULL, 'ASIGNADO'),
(69, 13, 8, '2024-10-01', NULL, NULL, 'ASIGNADO'),
(70, 14, 9, '2024-10-19', NULL, NULL, 'ASIGNADO'),
(71, 15, 10, '2024-10-20', NULL, NULL, 'ASIGNADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sistema`
--

CREATE TABLE `usuario_sistema` (
  `id` bigint(20) NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` bigint(20) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_sistema`
--

INSERT INTO `usuario_sistema` (`id`, `nombre`, `email`, `password`, `perfil`, `fecha_actualizacion`, `fecha_creacion`, `token`, `estado`) VALUES
(7, 'Leo', 'leonardoesteban770@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2024-10-13 15:37:07', '2024-09-27 02:45:17', NULL, 1),
(8, 'Usuario Administrador', 'admin@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2024-10-11 15:28:14', '2024-09-27 02:47:25', NULL, 1),
(12, 'Fontanero', 'fontanero@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Fontanero', '2024-10-18 15:05:29', '2024-10-18 21:05:29', NULL, 1),
(13, 'Secretario', 'secreteario@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Secretario', '2024-10-18 15:05:54', '2024-10-18 21:05:54', NULL, 1),
(14, 'Tesorero', 'tesorero@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Tesorero', '2024-10-18 15:06:17', '2024-10-18 21:06:17', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cobro_base`
--
ALTER TABLE `cobro_base`
  ADD PRIMARY KEY (`idcobro_base`),
  ADD KEY `fk_cobro_base_usuario_contador` (`idusuario_contador`),
  ADD KEY `fk_cobro_base_tarifa` (`idtarifa`);

--
-- Indices de la tabla `cobro_servicio`
--
ALTER TABLE `cobro_servicio`
  ADD PRIMARY KEY (`idcobro`),
  ADD KEY `idlectura` (`idlectura`),
  ADD KEY `fk_cobro_usuario_contador` (`idusuario_contador`);

--
-- Indices de la tabla `contador`
--
ALTER TABLE `contador`
  ADD PRIMARY KEY (`idcontador`);

--
-- Indices de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
  ADD PRIMARY KEY (`idestado_cuenta`),
  ADD KEY `fk_estado_cuenta_usuario_contador` (`idusuario_contador`);

--
-- Indices de la tabla `lectura`
--
ALTER TABLE `lectura`
  ADD PRIMARY KEY (`idlectura`),
  ADD KEY `lectura_ibfk_1` (`idusuario_contador`);

--
-- Indices de la tabla `pago_servicio`
--
ALTER TABLE `pago_servicio`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `idcobro` (`idcobro`),
  ADD KEY `idusuario_contador` (`idusuario_contador`),
  ADD KEY `idcobro_base` (`idcobro_base`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`idtarifa`);

--
-- Indices de la tabla `titulo_propiedad`
--
ALTER TABLE `titulo_propiedad`
  ADD PRIMARY KEY (`idtitulo`),
  ADD KEY `idx_titulo_propiedad` (`idusuario_contador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_contador`
--
ALTER TABLE `usuario_contador`
  ADD PRIMARY KEY (`idusuario_contador`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcontador` (`idcontador`);

--
-- Indices de la tabla `usuario_contador_historial`
--
ALTER TABLE `usuario_contador_historial`
  ADD PRIMARY KEY (`idusuario_contador_historial`),
  ADD KEY `idx_historial_idusuario` (`idusuario`),
  ADD KEY `idx_historial_idcontador` (`idcontador`);

--
-- Indices de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cobro_base`
--
ALTER TABLE `cobro_base`
  MODIFY `idcobro_base` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `cobro_servicio`
--
ALTER TABLE `cobro_servicio`
  MODIFY `idcobro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `contador`
--
ALTER TABLE `contador`
  MODIFY `idcontador` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
  MODIFY `idestado_cuenta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `lectura`
--
ALTER TABLE `lectura`
  MODIFY `idlectura` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `pago_servicio`
--
ALTER TABLE `pago_servicio`
  MODIFY `idpago` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `idtarifa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `titulo_propiedad`
--
ALTER TABLE `titulo_propiedad`
  MODIFY `idtitulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario_contador`
--
ALTER TABLE `usuario_contador`
  MODIFY `idusuario_contador` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuario_contador_historial`
--
ALTER TABLE `usuario_contador_historial`
  MODIFY `idusuario_contador_historial` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cobro_base`
--
ALTER TABLE `cobro_base`
  ADD CONSTRAINT `fk_cobro_base_tarifa` FOREIGN KEY (`idtarifa`) REFERENCES `tarifa` (`idtarifa`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cobro_base_usuario_contador` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cobro_servicio`
--
ALTER TABLE `cobro_servicio`
  ADD CONSTRAINT `cobro_servicio_ibfk_2` FOREIGN KEY (`idlectura`) REFERENCES `lectura` (`idlectura`),
  ADD CONSTRAINT `fk_cobro_usuario_contador` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
  ADD CONSTRAINT `fk_estado_cuenta_usuario_contador` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lectura`
--
ALTER TABLE `lectura`
  ADD CONSTRAINT `lectura_ibfk_1` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`);

--
-- Filtros para la tabla `pago_servicio`
--
ALTER TABLE `pago_servicio`
  ADD CONSTRAINT `pago_servicio_ibfk_1` FOREIGN KEY (`idcobro`) REFERENCES `cobro_servicio` (`idcobro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_servicio_ibfk_2` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_servicio_ibfk_3` FOREIGN KEY (`idcobro_base`) REFERENCES `cobro_base` (`idcobro_base`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `titulo_propiedad`
--
ALTER TABLE `titulo_propiedad`
  ADD CONSTRAINT `titulo_propiedad_ibfk_1` FOREIGN KEY (`idusuario_contador`) REFERENCES `usuario_contador` (`idusuario_contador`);

--
-- Filtros para la tabla `usuario_contador`
--
ALTER TABLE `usuario_contador`
  ADD CONSTRAINT `usuario_contador_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuario_contador_ibfk_2` FOREIGN KEY (`idcontador`) REFERENCES `contador` (`idcontador`);

--
-- Filtros para la tabla `usuario_contador_historial`
--
ALTER TABLE `usuario_contador_historial`
  ADD CONSTRAINT `usuario_contador_historial_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuario_contador_historial_ibfk_2` FOREIGN KEY (`idcontador`) REFERENCES `contador` (`idcontador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
