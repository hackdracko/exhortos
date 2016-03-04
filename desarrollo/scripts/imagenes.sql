CREATE DATABASE  IF NOT EXISTS `htsj_exhortos` ;
USE `htsj_exhortos`;


--
-- Table structure for table `tbldocumentos`
--

DROP TABLE IF EXISTS `tbldocumentos`;

CREATE TABLE `tbldocumentos` (
  `cveDocumento` int(2) NOT NULL AUTO_INCREMENT,
  `descDocumento` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `activo` char(1) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'S',
  `fechaActualizacion` datetime DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `cveTipoNumero` int(2) DEFAULT NULL,
  PRIMARY KEY (`cveDocumento`),
  KEY `tbldocumentos_activo_idx` (`activo`),
  KEY `tbldocumentos_cveTipoNumero_idx` (`cveTipoNumero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS `tbldocumentosimg`;

CREATE TABLE `tbldocumentosimg` (
  `idDocumentoImg` int(11) NOT NULL AUTO_INCREMENT,
  `idReferencia` int(11) DEFAULT NULL,
  `cveTipoDocumento` int(3) NOT NULL,
  `fechaDocumento` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `observaciones` text COLLATE latin1_spanish_ci,
  `cveUsuario` int(11) DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  PRIMARY KEY (`idDocumentoImg`),
  KEY `tbldocumentosimg_cveTipoDocumento_fk` (`cveTipoDocumento`),
  KEY `tbldocumentosimg_idReferencia_idx` (`idReferencia`),
  KEY `tbldocumentosimg_fechaRegistro_idx` (`fechaRegistro`),
  CONSTRAINT `tbldocumentosimg_cveTipoDocumento_fk` FOREIGN KEY (`cveTipoDocumento`) REFERENCES `tbltiposdocumentos` (`cveTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- Table structure for table `tblimagenes`
--

DROP TABLE IF EXISTS `tblimagenes`;

CREATE TABLE `tblimagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `idDocumentoImg` int(11) NOT NULL,
  `fojas` int(3) DEFAULT NULL,
  `ruta` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `posicion` int(5) DEFAULT NULL,
  `activo` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fechaImagen` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `adjunto` char(1) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idImagen`),
  KEY `tblimagenes_idDocumentoImg_fk_idx` (`idDocumentoImg`),
  KEY `tblimagenes_adjunto_idx` (`adjunto`),
  KEY `tblimagenes_activo_idx` (`activo`),
  KEY `tblimagenes_fechaRegsitro_idx` (`fechaRegistro`),
  KEY `ruta` (`ruta`),
  CONSTRAINT `tblimagenes_idDocumentoImg_fk` FOREIGN KEY (`idDocumentoImg`) REFERENCES `tbldocumentosimg` (`idDocumentoImg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

