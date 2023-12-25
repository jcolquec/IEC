/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28-11-2023 17:22:43                          */
/*==============================================================*/


drop table if exists ANIO;

drop table if exists BITACORA;

drop table if exists CIUDAD;

drop table if exists COMUNA;

drop table if exists ESTACION;

drop table if exists ESTACION_REGISTRA_VARIABLE;

drop table if exists GEOGRAFIA;

drop table if exists HECHO_IEC;

drop table if exists INSTRUMENTO;

drop table if exists ORGANIZACION_RESPONSABLE;

drop table if exists PAIS;

drop table if exists PERSONA_RESPONSABLE;

drop table if exists PROCESAMIENTO_DATOS;

drop table if exists REGION;

drop table if exists TIPOESTACION;

drop table if exists VARIABLE_METEOROLOGICA;

/*==============================================================*/
/* Table: ANIO                                                  */
/*==============================================================*/
create table ANIO
(
   IDANIO               int not null,
   primary key (IDANIO)
);

/*==============================================================*/
/* Table: BITACORA                                              */
/*==============================================================*/
create table BITACORA
(
   IDEVENTO             int not null auto_increment,
   IDESTACION           int not null,
   EVENTONOMB           varchar(100),
   EVENTOFECHA          datetime,
   COMENTARIOSBIT       varchar(5000),
   TIPOCOMENTARIO       varchar(40),
   primary key (IDEVENTO)
);

/*==============================================================*/
/* Table: CIUDAD                                                */
/*==============================================================*/
create table CIUDAD
(
   IDCIUDAD             int not null auto_increment,
   IDREGION             int not null,
   CIUDADNOMB           varchar(40),
   primary key (IDCIUDAD)
);

/*==============================================================*/
/* Table: COMUNA                                                */
/*==============================================================*/
create table COMUNA
(
   IDCOMUNA             int not null auto_increment,
   IDCIUDAD             int not null,
   COMUNANOMB           varchar(60),
   primary key (IDCOMUNA)
);

/*==============================================================*/
/* Table: ESTACION                                              */
/*==============================================================*/
create table ESTACION
(
   IDESTACION           int not null auto_increment,
   IDCOMUNA             int not null,
   IDORGRESP            int not null,
   IDTIPOESTACION       int not null,
   CODIGOESTACION       varchar(50),
   NROSERIE             int,
   NOMBRELOCAL          varchar(40),
   NOMBREESTACION       varchar(40),
   ESTADOESTACION       varchar(30),
   FECHAINIACT          date,
   FECHATERMINOACT      date,
   COMENTARIO           varchar(50),
   HUSOHORARIO          varchar(50),
   RIONOMB              varchar(100),
   CUENCANOMB           varchar(100),
   TIPODATOS            varchar(40),
   primary key (IDESTACION)
);

/*==============================================================*/
/* Table: ESTACION_REGISTRA_VARIABLE                            */
/*==============================================================*/
create table ESTACION_REGISTRA_VARIABLE
(
   IDESTACION           int not null,
   IDVARMETEOROLOGICA   int not null,
   FECHA                date not null,
   HORA                 time not null,
   VALORVARIABLE        decimal(10,4) not null,
   UNIDMEDIDA           varchar(20) not null,
   TIPODATOTEMPORAL     varchar(20) not null,
   primary key (IDESTACION, IDVARMETEOROLOGICA, FECHA, HORA, TIPODATOTEMPORAL)
);

/*==============================================================*/
/* Table: GEOGRAFIA                                             */
/*==============================================================*/
create table GEOGRAFIA
(
   IDGEOGRAFIA          int not null auto_increment,
   IDESTACION           int not null,
   LATITUD              decimal(12,8),
   LONGITUD             decimal(12,8),
   ALTITUD              decimal(12,8),
   FECHAINSTALACION     date,
   INFOTOPOG            varchar(200),
   DATUM                varchar(100),
   primary key (IDGEOGRAFIA)
);

/*==============================================================*/
/* Table: HECHO_IEC                                             */
/*==============================================================*/
create table HECHO_IEC
(
   IDHECHO              int not null auto_increment,
   IDESTACION           int not null,
   IDPROCESO            int not null,
   IDANIO               int not null,
   FD                   decimal(10,5),
   SU                   decimal(10,5),
   ID                   decimal(10,5),
   TR                   decimal(10,5),
   GSL                  decimal(10,5),
   TXX                  decimal(10,5),
   TNX                  decimal(10,5),
   TXN                  decimal(10,5),
   TNN                  decimal(10,5),
   TN10P                decimal(10,5),
   TX10P                decimal(10,5),
   TN90P                decimal(10,5),
   TX90P                decimal(10,5),
   WSDI                 decimal(10,5),
   CSDI                 decimal(10,5),
   DTR                  decimal(10,5),
   RX1DAY               decimal(10,5),
   RX5DAY               decimal(10,5),
   SDII                 decimal(10,5),
   R10MM                decimal(10,5),
   R20MM                decimal(10,5),
   RNNMM                decimal(10,5),
   CDD                  decimal(10,5),
   CWD                  decimal(10,5),
   R95PTOT              decimal(10,5),
   R99PTOT              decimal(10,5),
   PRCPTOT              decimal(10,5),
   primary key (IDHECHO)
);

/*==============================================================*/
/* Table: INSTRUMENTO                                           */
/*==============================================================*/
create table INSTRUMENTO
(
   IDINSTRUM            int not null auto_increment,
   IDESTACION           int not null,
   INSTRUMNOMB          varchar(50),
   INSTRUMTIPO          varchar(50),
   INSTRUMESTADO        varchar(30),
   primary key (IDINSTRUM)
);

/*==============================================================*/
/* Table: ORGANIZACION_RESPONSABLE                              */
/*==============================================================*/
create table ORGANIZACION_RESPONSABLE
(
   IDORGRESP            int not null auto_increment,
   ORGNOMB              varchar(80),
   ORGTELEFONO          varchar(15),
   ORGEMAIL             varchar(60),
   ROL                  varchar(20),
   ORGRUT               varchar(20),
   primary key (IDORGRESP)
);

/*==============================================================*/
/* Table: PAIS                                                  */
/*==============================================================*/
create table PAIS
(
   IDPAIS               int not null auto_increment,
   PAISNOMB             varchar(40),
   primary key (IDPAIS)
);

/*==============================================================*/
/* Table: PERSONA_RESPONSABLE                                   */
/*==============================================================*/
create table PERSONA_RESPONSABLE
(
   IDPERSONA            int not null auto_increment,
   IDORGRESP            int not null,
   PERSONANOMB          varchar(80),
   PERSONATELEFONO      varchar(20),
   PERSONAEMAIL         varchar(50),
   PERSONARUT           varchar(20),
   PERSONAROL           varchar(20),
   PERSONADIR           varchar(100),
   PERSONACLAVE         varchar(12),
   primary key (IDPERSONA)
);

/*==============================================================*/
/* Table: PROCESAMIENTO_DATOS                                   */
/*==============================================================*/
create table PROCESAMIENTO_DATOS
(
   IDPROCESO            int not null auto_increment,
   UNIDADMED            varchar(30),
   PORCENTCALIDAD       decimal(10,2),
   CANTDATOS            int,
   CONFIANZA            varchar(20),
   primary key (IDPROCESO)
);

/*==============================================================*/
/* Table: REGION                                                */
/*==============================================================*/
create table REGION
(
   IDREGION             int not null auto_increment,
   IDPAIS               int not null,
   REGIONNOMB           varchar(60),
   primary key (IDREGION)
);

/*==============================================================*/
/* Table: TIPOESTACION                                          */
/*==============================================================*/
create table TIPOESTACION
(
   IDTIPOESTACION       int not null auto_increment,
   TIPOESTNOMB          varchar(30),
   primary key (IDTIPOESTACION)
);

/*==============================================================*/
/* Table: VARIABLE_METEOROLOGICA                                */
/*==============================================================*/
create table VARIABLE_METEOROLOGICA
(
   IDVARMETEOROLOGICA   int not null auto_increment,
   NOMBREVAR            varchar(20),
   NOMBREVARCORTO       varchar(10),
   primary key (IDVARMETEOROLOGICA)
);

alter table BITACORA add constraint FK_ESTACION_REGISTRA_BITACORA foreign key (IDESTACION)
      references ESTACION (IDESTACION) on delete restrict on update restrict;

alter table CIUDAD add constraint FK_CIUDAD_PERTENECE_A_REGION foreign key (IDREGION)
      references REGION (IDREGION) on delete restrict on update restrict;

alter table COMUNA add constraint FK_COMUNA_PERTENECE_A_CIUDAD foreign key (IDCIUDAD)
      references CIUDAD (IDCIUDAD) on delete restrict on update restrict;

alter table ESTACION add constraint FK_ESTACION_PERTENECE_A_COMUNA foreign key (IDCOMUNA)
      references COMUNA (IDCOMUNA) on delete restrict on update restrict;

alter table ESTACION add constraint FK_ESTACION_PERTENECE_A_ORG_RESP foreign key (IDORGRESP)
      references ORGANIZACION_RESPONSABLE (IDORGRESP) on delete restrict on update restrict;

alter table ESTACION add constraint FK_ESTACION_TIENE_TIPO_ESTACION foreign key (IDTIPOESTACION)
      references TIPOESTACION (IDTIPOESTACION) on delete restrict on update restrict;

alter table ESTACION_REGISTRA_VARIABLE add constraint FK_ESTACION_REGISTRA_VARIABLE foreign key (IDESTACION)
      references ESTACION (IDESTACION) on delete restrict on update restrict;

alter table ESTACION_REGISTRA_VARIABLE add constraint FK_ESTACION_REGISTRA_VARIABLE2 foreign key (IDVARMETEOROLOGICA)
      references VARIABLE_METEOROLOGICA (IDVARMETEOROLOGICA) on delete restrict on update restrict;

alter table GEOGRAFIA add constraint FK_GEOGRAFIA_PERTENECE_A_ESTACION foreign key (IDESTACION)
      references ESTACION (IDESTACION) on delete restrict on update restrict;

alter table HECHO_IEC add constraint FK_HECHO_IEC_PERTENECE_A_ANIO foreign key (IDANIO)
      references ANIO (IDANIO) on delete restrict on update restrict;

alter table HECHO_IEC add constraint FK_HECHO_IEC_PERTENECE_A_ESTACION foreign key (IDESTACION)
      references ESTACION (IDESTACION) on delete restrict on update restrict;

alter table HECHO_IEC add constraint FK_HECHO_IEC_PERTENECE_A_PROCESO foreign key (IDPROCESO)
      references PROCESAMIENTO_DATOS (IDPROCESO) on delete restrict on update restrict;

alter table INSTRUMENTO add constraint FK_INSTRUMENTO_PERTENECE_A_ESTACION foreign key (IDESTACION)
      references ESTACION (IDESTACION) on delete restrict on update restrict;

alter table PERSONA_RESPONSABLE add constraint FK_PERSONA_RESP_PERTENECE_A_ORG_RESP foreign key (IDORGRESP)
      references ORGANIZACION_RESPONSABLE (IDORGRESP) on delete restrict on update restrict;

alter table REGION add constraint FK_REGION_PERTENECE_A_PAIS foreign key (IDPAIS)
      references PAIS (IDPAIS) on delete restrict on update restrict;

