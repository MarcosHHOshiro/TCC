PGDMP  1                	    |            postgres    16.3 (Debian 16.3-1.pgdg120+1)    16.0 x    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    5    postgres    DATABASE     s   CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE postgres;
                postgres    false            �           0    0    DATABASE postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                   postgres    false    3514            �            1259    16387    rl_acesso_questionario    TABLE     �   CREATE TABLE public.rl_acesso_questionario (
    id_acesso integer NOT NULL,
    id_url integer,
    id_usuario integer,
    respondeu_questionario boolean DEFAULT false,
    respondeu_checklist boolean DEFAULT false
);
 *   DROP TABLE public.rl_acesso_questionario;
       public         heap    postgres    false            �            1259    16390 $   rl_acesso_questionario_id_acesso_seq    SEQUENCE     �   CREATE SEQUENCE public.rl_acesso_questionario_id_acesso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.rl_acesso_questionario_id_acesso_seq;
       public          postgres    false    215            �           0    0 $   rl_acesso_questionario_id_acesso_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.rl_acesso_questionario_id_acesso_seq OWNED BY public.rl_acesso_questionario.id_acesso;
          public          postgres    false    216            �            1259    16391 	   tb_cidade    TABLE     �   CREATE TABLE public.tb_cidade (
    id_cidade integer NOT NULL,
    nome_cidade character varying(100),
    id_estado integer
);
    DROP TABLE public.tb_cidade;
       public         heap    postgres    false            �            1259    16394    tb_cidade_id_cidade_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_cidade_id_cidade_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tb_cidade_id_cidade_seq;
       public          postgres    false    217            �           0    0    tb_cidade_id_cidade_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tb_cidade_id_cidade_seq OWNED BY public.tb_cidade.id_cidade;
          public          postgres    false    218            �            1259    16395    tb_escolaridade    TABLE     �   CREATE TABLE public.tb_escolaridade (
    id_escolaridade integer NOT NULL,
    nome_escolaridade character varying(100),
    ativa boolean
);
 #   DROP TABLE public.tb_escolaridade;
       public         heap    postgres    false            �            1259    16398 #   tb_escolaridade_id_escolaridade_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_escolaridade_id_escolaridade_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.tb_escolaridade_id_escolaridade_seq;
       public          postgres    false    219            �           0    0 #   tb_escolaridade_id_escolaridade_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.tb_escolaridade_id_escolaridade_seq OWNED BY public.tb_escolaridade.id_escolaridade;
          public          postgres    false    220            �            1259    16399 	   tb_estado    TABLE     �   CREATE TABLE public.tb_estado (
    id_estado integer NOT NULL,
    nome_estado character varying(100),
    sigla character(3)
);
    DROP TABLE public.tb_estado;
       public         heap    postgres    false            �            1259    16402    tb_estado_id_estado_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_estado_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tb_estado_id_estado_seq;
       public          postgres    false    221            �           0    0    tb_estado_id_estado_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tb_estado_id_estado_seq OWNED BY public.tb_estado.id_estado;
          public          postgres    false    222            �            1259    16403    tb_papel    TABLE     �   CREATE TABLE public.tb_papel (
    id_papel integer NOT NULL,
    nome character varying(255) NOT NULL,
    descricao text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.tb_papel;
       public         heap    postgres    false            �            1259    16409    tb_papel_id_papel_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_papel_id_papel_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tb_papel_id_papel_seq;
       public          postgres    false    223            �           0    0    tb_papel_id_papel_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tb_papel_id_papel_seq OWNED BY public.tb_papel.id_papel;
          public          postgres    false    224            �            1259    16410    tb_papel_permissao    TABLE     m   CREATE TABLE public.tb_papel_permissao (
    id_papel integer NOT NULL,
    id_permissao integer NOT NULL
);
 &   DROP TABLE public.tb_papel_permissao;
       public         heap    postgres    false            �            1259    16413    tb_perguntas    TABLE     �   CREATE TABLE public.tb_perguntas (
    id_pergunta integer NOT NULL,
    id_questionario integer,
    descricao text,
    id_principio integer,
    justificativa text
);
     DROP TABLE public.tb_perguntas;
       public         heap    postgres    false            �            1259    16418    tb_perguntas_id_pergunta_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_perguntas_id_pergunta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tb_perguntas_id_pergunta_seq;
       public          postgres    false    226            �           0    0    tb_perguntas_id_pergunta_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tb_perguntas_id_pergunta_seq OWNED BY public.tb_perguntas.id_pergunta;
          public          postgres    false    227            �            1259    16419    tb_permissao    TABLE     �   CREATE TABLE public.tb_permissao (
    id_permissao integer NOT NULL,
    nome character varying(255) NOT NULL,
    descricao text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
     DROP TABLE public.tb_permissao;
       public         heap    postgres    false            �            1259    16425    tb_permissao_id_permissao_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_permissao_id_permissao_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tb_permissao_id_permissao_seq;
       public          postgres    false    228            �           0    0    tb_permissao_id_permissao_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tb_permissao_id_permissao_seq OWNED BY public.tb_permissao.id_permissao;
          public          postgres    false    229            �            1259    16426    tb_principio    TABLE     n   CREATE TABLE public.tb_principio (
    id_principio integer NOT NULL,
    descricao character varying(100)
);
     DROP TABLE public.tb_principio;
       public         heap    postgres    false            �            1259    16429    tb_principio_id_principio_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_principio_id_principio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tb_principio_id_principio_seq;
       public          postgres    false    230            �           0    0    tb_principio_id_principio_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tb_principio_id_principio_seq OWNED BY public.tb_principio.id_principio;
          public          postgres    false    231            �            1259    16430    tb_profissao    TABLE     �   CREATE TABLE public.tb_profissao (
    id_profissao integer NOT NULL,
    nome_profissao character varying(256),
    ativa boolean
);
     DROP TABLE public.tb_profissao;
       public         heap    postgres    false            �            1259    16433    tb_profissao_id_profissao_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_profissao_id_profissao_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tb_profissao_id_profissao_seq;
       public          postgres    false    232            �           0    0    tb_profissao_id_profissao_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tb_profissao_id_profissao_seq OWNED BY public.tb_profissao.id_profissao;
          public          postgres    false    233            �            1259    16434    tb_questionario    TABLE     o  CREATE TABLE public.tb_questionario (
    id_questionario integer NOT NULL,
    titulo character varying(100),
    descricao text,
    id_usuario_criou integer,
    padrao boolean,
    data_inicio date,
    data_fim date,
    status character(1),
    id_profissao integer,
    id_escolaridade integer,
    tipo character(1) DEFAULT 'Q'::bpchar,
    id_url integer
);
 #   DROP TABLE public.tb_questionario;
       public         heap    postgres    false            �            1259    16440 #   tb_questionario_id_questionario_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_questionario_id_questionario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.tb_questionario_id_questionario_seq;
       public          postgres    false    234            �           0    0 #   tb_questionario_id_questionario_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.tb_questionario_id_questionario_seq OWNED BY public.tb_questionario.id_questionario;
          public          postgres    false    235            �            1259    16592    tb_resposta    TABLE     �   CREATE TABLE public.tb_resposta (
    id_resposta integer NOT NULL,
    id_usuario integer,
    id_pergunta integer,
    resposta character(1),
    descricao text
);
    DROP TABLE public.tb_resposta;
       public         heap    postgres    false            �            1259    16591    tb_resposta_id_resposta_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_resposta_id_resposta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tb_resposta_id_resposta_seq;
       public          postgres    false    242            �           0    0    tb_resposta_id_resposta_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tb_resposta_id_resposta_seq OWNED BY public.tb_resposta.id_resposta;
          public          postgres    false    241            �            1259    16441    tb_url    TABLE     �   CREATE TABLE public.tb_url (
    id_url integer NOT NULL,
    url text,
    descricao text,
    tipo_site character varying(255),
    data_inicio date,
    data_fim date
);
    DROP TABLE public.tb_url;
       public         heap    postgres    false            �            1259    16446    tb_url_id_url_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_url_id_url_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.tb_url_id_url_seq;
       public          postgres    false    236            �           0    0    tb_url_id_url_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.tb_url_id_url_seq OWNED BY public.tb_url.id_url;
          public          postgres    false    237            �            1259    16447 
   tb_usuario    TABLE     �  CREATE TABLE public.tb_usuario (
    id_usuario integer NOT NULL,
    nome_usuario character varying(256),
    email character varying(256),
    data_nascimento date,
    sexo character(1),
    login character varying(256),
    senha character varying(256),
    status_usuario character(1),
    id_profissao integer,
    id_escolaridade integer,
    id_cidade integer,
    permitido boolean,
    permissao character(1) DEFAULT 'U'::bpchar
);
    DROP TABLE public.tb_usuario;
       public         heap    postgres    false            �            1259    16453    tb_usuario_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_usuario_id_usuario_seq;
       public          postgres    false    238            �           0    0    tb_usuario_id_usuario_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_usuario_id_usuario_seq OWNED BY public.tb_usuario.id_usuario;
          public          postgres    false    239            �            1259    16454    tb_usuario_papel    TABLE     i   CREATE TABLE public.tb_usuario_papel (
    id_usuario integer NOT NULL,
    id_papel integer NOT NULL
);
 $   DROP TABLE public.tb_usuario_papel;
       public         heap    postgres    false            �           2604    16457     rl_acesso_questionario id_acesso    DEFAULT     �   ALTER TABLE ONLY public.rl_acesso_questionario ALTER COLUMN id_acesso SET DEFAULT nextval('public.rl_acesso_questionario_id_acesso_seq'::regclass);
 O   ALTER TABLE public.rl_acesso_questionario ALTER COLUMN id_acesso DROP DEFAULT;
       public          postgres    false    216    215            �           2604    16458    tb_cidade id_cidade    DEFAULT     z   ALTER TABLE ONLY public.tb_cidade ALTER COLUMN id_cidade SET DEFAULT nextval('public.tb_cidade_id_cidade_seq'::regclass);
 B   ALTER TABLE public.tb_cidade ALTER COLUMN id_cidade DROP DEFAULT;
       public          postgres    false    218    217            �           2604    16459    tb_escolaridade id_escolaridade    DEFAULT     �   ALTER TABLE ONLY public.tb_escolaridade ALTER COLUMN id_escolaridade SET DEFAULT nextval('public.tb_escolaridade_id_escolaridade_seq'::regclass);
 N   ALTER TABLE public.tb_escolaridade ALTER COLUMN id_escolaridade DROP DEFAULT;
       public          postgres    false    220    219            �           2604    16460    tb_estado id_estado    DEFAULT     z   ALTER TABLE ONLY public.tb_estado ALTER COLUMN id_estado SET DEFAULT nextval('public.tb_estado_id_estado_seq'::regclass);
 B   ALTER TABLE public.tb_estado ALTER COLUMN id_estado DROP DEFAULT;
       public          postgres    false    222    221            �           2604    16461    tb_papel id_papel    DEFAULT     v   ALTER TABLE ONLY public.tb_papel ALTER COLUMN id_papel SET DEFAULT nextval('public.tb_papel_id_papel_seq'::regclass);
 @   ALTER TABLE public.tb_papel ALTER COLUMN id_papel DROP DEFAULT;
       public          postgres    false    224    223            �           2604    16462    tb_perguntas id_pergunta    DEFAULT     �   ALTER TABLE ONLY public.tb_perguntas ALTER COLUMN id_pergunta SET DEFAULT nextval('public.tb_perguntas_id_pergunta_seq'::regclass);
 G   ALTER TABLE public.tb_perguntas ALTER COLUMN id_pergunta DROP DEFAULT;
       public          postgres    false    227    226            �           2604    16463    tb_permissao id_permissao    DEFAULT     �   ALTER TABLE ONLY public.tb_permissao ALTER COLUMN id_permissao SET DEFAULT nextval('public.tb_permissao_id_permissao_seq'::regclass);
 H   ALTER TABLE public.tb_permissao ALTER COLUMN id_permissao DROP DEFAULT;
       public          postgres    false    229    228            �           2604    16464    tb_principio id_principio    DEFAULT     �   ALTER TABLE ONLY public.tb_principio ALTER COLUMN id_principio SET DEFAULT nextval('public.tb_principio_id_principio_seq'::regclass);
 H   ALTER TABLE public.tb_principio ALTER COLUMN id_principio DROP DEFAULT;
       public          postgres    false    231    230            �           2604    16465    tb_profissao id_profissao    DEFAULT     �   ALTER TABLE ONLY public.tb_profissao ALTER COLUMN id_profissao SET DEFAULT nextval('public.tb_profissao_id_profissao_seq'::regclass);
 H   ALTER TABLE public.tb_profissao ALTER COLUMN id_profissao DROP DEFAULT;
       public          postgres    false    233    232            �           2604    16466    tb_questionario id_questionario    DEFAULT     �   ALTER TABLE ONLY public.tb_questionario ALTER COLUMN id_questionario SET DEFAULT nextval('public.tb_questionario_id_questionario_seq'::regclass);
 N   ALTER TABLE public.tb_questionario ALTER COLUMN id_questionario DROP DEFAULT;
       public          postgres    false    235    234            �           2604    16595    tb_resposta id_resposta    DEFAULT     �   ALTER TABLE ONLY public.tb_resposta ALTER COLUMN id_resposta SET DEFAULT nextval('public.tb_resposta_id_resposta_seq'::regclass);
 F   ALTER TABLE public.tb_resposta ALTER COLUMN id_resposta DROP DEFAULT;
       public          postgres    false    242    241    242            �           2604    16467    tb_url id_url    DEFAULT     n   ALTER TABLE ONLY public.tb_url ALTER COLUMN id_url SET DEFAULT nextval('public.tb_url_id_url_seq'::regclass);
 <   ALTER TABLE public.tb_url ALTER COLUMN id_url DROP DEFAULT;
       public          postgres    false    237    236            �           2604    16468    tb_usuario id_usuario    DEFAULT     ~   ALTER TABLE ONLY public.tb_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.tb_usuario_id_usuario_seq'::regclass);
 D   ALTER TABLE public.tb_usuario ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    239    238            �          0    16387    rl_acesso_questionario 
   TABLE DATA           |   COPY public.rl_acesso_questionario (id_acesso, id_url, id_usuario, respondeu_questionario, respondeu_checklist) FROM stdin;
    public          postgres    false    215   8�       �          0    16391 	   tb_cidade 
   TABLE DATA           F   COPY public.tb_cidade (id_cidade, nome_cidade, id_estado) FROM stdin;
    public          postgres    false    217   o�       �          0    16395    tb_escolaridade 
   TABLE DATA           T   COPY public.tb_escolaridade (id_escolaridade, nome_escolaridade, ativa) FROM stdin;
    public          postgres    false    219   ��       �          0    16399 	   tb_estado 
   TABLE DATA           B   COPY public.tb_estado (id_estado, nome_estado, sigla) FROM stdin;
    public          postgres    false    221   Ș       �          0    16403    tb_papel 
   TABLE DATA           I   COPY public.tb_papel (id_papel, nome, descricao, created_at) FROM stdin;
    public          postgres    false    223   �       �          0    16410    tb_papel_permissao 
   TABLE DATA           D   COPY public.tb_papel_permissao (id_papel, id_permissao) FROM stdin;
    public          postgres    false    225   S�       �          0    16413    tb_perguntas 
   TABLE DATA           l   COPY public.tb_perguntas (id_pergunta, id_questionario, descricao, id_principio, justificativa) FROM stdin;
    public          postgres    false    226   }�       �          0    16419    tb_permissao 
   TABLE DATA           Q   COPY public.tb_permissao (id_permissao, nome, descricao, created_at) FROM stdin;
    public          postgres    false    228   x�       �          0    16426    tb_principio 
   TABLE DATA           ?   COPY public.tb_principio (id_principio, descricao) FROM stdin;
    public          postgres    false    230   #�       �          0    16430    tb_profissao 
   TABLE DATA           K   COPY public.tb_profissao (id_profissao, nome_profissao, ativa) FROM stdin;
    public          postgres    false    232   N�       �          0    16434    tb_questionario 
   TABLE DATA           �   COPY public.tb_questionario (id_questionario, titulo, descricao, id_usuario_criou, padrao, data_inicio, data_fim, status, id_profissao, id_escolaridade, tipo, id_url) FROM stdin;
    public          postgres    false    234   ��       �          0    16592    tb_resposta 
   TABLE DATA           `   COPY public.tb_resposta (id_resposta, id_usuario, id_pergunta, resposta, descricao) FROM stdin;
    public          postgres    false    242   ��       �          0    16441    tb_url 
   TABLE DATA           Z   COPY public.tb_url (id_url, url, descricao, tipo_site, data_inicio, data_fim) FROM stdin;
    public          postgres    false    236   ؜       �          0    16447 
   tb_usuario 
   TABLE DATA           �   COPY public.tb_usuario (id_usuario, nome_usuario, email, data_nascimento, sexo, login, senha, status_usuario, id_profissao, id_escolaridade, id_cidade, permitido, permissao) FROM stdin;
    public          postgres    false    238   a�       �          0    16454    tb_usuario_papel 
   TABLE DATA           @   COPY public.tb_usuario_papel (id_usuario, id_papel) FROM stdin;
    public          postgres    false    240   ޞ       �           0    0 $   rl_acesso_questionario_id_acesso_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.rl_acesso_questionario_id_acesso_seq', 4, true);
          public          postgres    false    216            �           0    0    tb_cidade_id_cidade_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tb_cidade_id_cidade_seq', 1, false);
          public          postgres    false    218            �           0    0 #   tb_escolaridade_id_escolaridade_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tb_escolaridade_id_escolaridade_seq', 2, true);
          public          postgres    false    220            �           0    0    tb_estado_id_estado_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tb_estado_id_estado_seq', 1, false);
          public          postgres    false    222            �           0    0    tb_papel_id_papel_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tb_papel_id_papel_seq', 2, true);
          public          postgres    false    224            �           0    0    tb_perguntas_id_pergunta_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tb_perguntas_id_pergunta_seq', 48, true);
          public          postgres    false    227            �           0    0    tb_permissao_id_permissao_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tb_permissao_id_permissao_seq', 4, true);
          public          postgres    false    229            �           0    0    tb_principio_id_principio_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tb_principio_id_principio_seq', 1, true);
          public          postgres    false    231            �           0    0    tb_profissao_id_profissao_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tb_profissao_id_profissao_seq', 2, true);
          public          postgres    false    233            �           0    0 #   tb_questionario_id_questionario_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.tb_questionario_id_questionario_seq', 29, true);
          public          postgres    false    235            �           0    0    tb_resposta_id_resposta_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tb_resposta_id_resposta_seq', 1, true);
          public          postgres    false    241            �           0    0    tb_url_id_url_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.tb_url_id_url_seq', 4, true);
          public          postgres    false    237            �           0    0    tb_usuario_id_usuario_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.tb_usuario_id_usuario_seq', 9, true);
          public          postgres    false    239            �           2606    16470 2   rl_acesso_questionario rl_acesso_questionario_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.rl_acesso_questionario
    ADD CONSTRAINT rl_acesso_questionario_pkey PRIMARY KEY (id_acesso);
 \   ALTER TABLE ONLY public.rl_acesso_questionario DROP CONSTRAINT rl_acesso_questionario_pkey;
       public            postgres    false    215            �           2606    16472    tb_cidade tb_cidade_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_cidade
    ADD CONSTRAINT tb_cidade_pkey PRIMARY KEY (id_cidade);
 B   ALTER TABLE ONLY public.tb_cidade DROP CONSTRAINT tb_cidade_pkey;
       public            postgres    false    217            �           2606    16474 $   tb_escolaridade tb_escolaridade_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.tb_escolaridade
    ADD CONSTRAINT tb_escolaridade_pkey PRIMARY KEY (id_escolaridade);
 N   ALTER TABLE ONLY public.tb_escolaridade DROP CONSTRAINT tb_escolaridade_pkey;
       public            postgres    false    219            �           2606    16476    tb_estado tb_estado_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_estado
    ADD CONSTRAINT tb_estado_pkey PRIMARY KEY (id_estado);
 B   ALTER TABLE ONLY public.tb_estado DROP CONSTRAINT tb_estado_pkey;
       public            postgres    false    221            �           2606    16478 *   tb_papel_permissao tb_papel_permissao_pkey 
   CONSTRAINT     |   ALTER TABLE ONLY public.tb_papel_permissao
    ADD CONSTRAINT tb_papel_permissao_pkey PRIMARY KEY (id_papel, id_permissao);
 T   ALTER TABLE ONLY public.tb_papel_permissao DROP CONSTRAINT tb_papel_permissao_pkey;
       public            postgres    false    225    225            �           2606    16480    tb_papel tb_papel_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tb_papel
    ADD CONSTRAINT tb_papel_pkey PRIMARY KEY (id_papel);
 @   ALTER TABLE ONLY public.tb_papel DROP CONSTRAINT tb_papel_pkey;
       public            postgres    false    223            �           2606    16482    tb_perguntas tb_perguntas_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tb_perguntas
    ADD CONSTRAINT tb_perguntas_pkey PRIMARY KEY (id_pergunta);
 H   ALTER TABLE ONLY public.tb_perguntas DROP CONSTRAINT tb_perguntas_pkey;
       public            postgres    false    226            �           2606    16484    tb_permissao tb_permissao_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tb_permissao
    ADD CONSTRAINT tb_permissao_pkey PRIMARY KEY (id_permissao);
 H   ALTER TABLE ONLY public.tb_permissao DROP CONSTRAINT tb_permissao_pkey;
       public            postgres    false    228            �           2606    16486    tb_principio tb_principio_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tb_principio
    ADD CONSTRAINT tb_principio_pkey PRIMARY KEY (id_principio);
 H   ALTER TABLE ONLY public.tb_principio DROP CONSTRAINT tb_principio_pkey;
       public            postgres    false    230            �           2606    16488    tb_profissao tb_profissao_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tb_profissao
    ADD CONSTRAINT tb_profissao_pkey PRIMARY KEY (id_profissao);
 H   ALTER TABLE ONLY public.tb_profissao DROP CONSTRAINT tb_profissao_pkey;
       public            postgres    false    232            �           2606    16490 $   tb_questionario tb_questionario_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.tb_questionario
    ADD CONSTRAINT tb_questionario_pkey PRIMARY KEY (id_questionario);
 N   ALTER TABLE ONLY public.tb_questionario DROP CONSTRAINT tb_questionario_pkey;
       public            postgres    false    234            �           2606    16597    tb_resposta tb_resposta_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.tb_resposta
    ADD CONSTRAINT tb_resposta_pkey PRIMARY KEY (id_resposta);
 F   ALTER TABLE ONLY public.tb_resposta DROP CONSTRAINT tb_resposta_pkey;
       public            postgres    false    242            �           2606    16492    tb_url tb_url_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.tb_url
    ADD CONSTRAINT tb_url_pkey PRIMARY KEY (id_url);
 <   ALTER TABLE ONLY public.tb_url DROP CONSTRAINT tb_url_pkey;
       public            postgres    false    236            �           2606    16494 &   tb_usuario_papel tb_usuario_papel_pkey 
   CONSTRAINT     v   ALTER TABLE ONLY public.tb_usuario_papel
    ADD CONSTRAINT tb_usuario_papel_pkey PRIMARY KEY (id_usuario, id_papel);
 P   ALTER TABLE ONLY public.tb_usuario_papel DROP CONSTRAINT tb_usuario_papel_pkey;
       public            postgres    false    240    240            �           2606    16496    tb_usuario tb_usuario_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_usuario
    ADD CONSTRAINT tb_usuario_pkey PRIMARY KEY (id_usuario);
 D   ALTER TABLE ONLY public.tb_usuario DROP CONSTRAINT tb_usuario_pkey;
       public            postgres    false    238            �           2606    16497 9   rl_acesso_questionario rl_acesso_questionario_id_url_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rl_acesso_questionario
    ADD CONSTRAINT rl_acesso_questionario_id_url_fkey FOREIGN KEY (id_url) REFERENCES public.tb_url(id_url);
 c   ALTER TABLE ONLY public.rl_acesso_questionario DROP CONSTRAINT rl_acesso_questionario_id_url_fkey;
       public          postgres    false    236    215    3313            �           2606    16502 =   rl_acesso_questionario rl_acesso_questionario_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rl_acesso_questionario
    ADD CONSTRAINT rl_acesso_questionario_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tb_usuario(id_usuario);
 g   ALTER TABLE ONLY public.rl_acesso_questionario DROP CONSTRAINT rl_acesso_questionario_id_usuario_fkey;
       public          postgres    false    215    3315    238            �           2606    16507 "   tb_cidade tb_cidade_id_estado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_cidade
    ADD CONSTRAINT tb_cidade_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.tb_estado(id_estado);
 L   ALTER TABLE ONLY public.tb_cidade DROP CONSTRAINT tb_cidade_id_estado_fkey;
       public          postgres    false    3297    217    221            �           2606    16512 3   tb_papel_permissao tb_papel_permissao_id_papel_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_papel_permissao
    ADD CONSTRAINT tb_papel_permissao_id_papel_fkey FOREIGN KEY (id_papel) REFERENCES public.tb_papel(id_papel);
 ]   ALTER TABLE ONLY public.tb_papel_permissao DROP CONSTRAINT tb_papel_permissao_id_papel_fkey;
       public          postgres    false    225    3299    223            �           2606    16517 7   tb_papel_permissao tb_papel_permissao_id_permissao_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_papel_permissao
    ADD CONSTRAINT tb_papel_permissao_id_permissao_fkey FOREIGN KEY (id_permissao) REFERENCES public.tb_permissao(id_permissao);
 a   ALTER TABLE ONLY public.tb_papel_permissao DROP CONSTRAINT tb_papel_permissao_id_permissao_fkey;
       public          postgres    false    228    3305    225            �           2606    16522 +   tb_perguntas tb_perguntas_id_principio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_perguntas
    ADD CONSTRAINT tb_perguntas_id_principio_fkey FOREIGN KEY (id_principio) REFERENCES public.tb_principio(id_principio);
 U   ALTER TABLE ONLY public.tb_perguntas DROP CONSTRAINT tb_perguntas_id_principio_fkey;
       public          postgres    false    226    3307    230            �           2606    16527 .   tb_perguntas tb_perguntas_id_questionario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_perguntas
    ADD CONSTRAINT tb_perguntas_id_questionario_fkey FOREIGN KEY (id_questionario) REFERENCES public.tb_questionario(id_questionario);
 X   ALTER TABLE ONLY public.tb_perguntas DROP CONSTRAINT tb_perguntas_id_questionario_fkey;
       public          postgres    false    226    234    3311            �           2606    16532 4   tb_questionario tb_questionario_id_escolaridade_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_questionario
    ADD CONSTRAINT tb_questionario_id_escolaridade_fkey FOREIGN KEY (id_escolaridade) REFERENCES public.tb_escolaridade(id_escolaridade);
 ^   ALTER TABLE ONLY public.tb_questionario DROP CONSTRAINT tb_questionario_id_escolaridade_fkey;
       public          postgres    false    219    3295    234                        2606    16537 1   tb_questionario tb_questionario_id_profissao_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_questionario
    ADD CONSTRAINT tb_questionario_id_profissao_fkey FOREIGN KEY (id_profissao) REFERENCES public.tb_profissao(id_profissao);
 [   ALTER TABLE ONLY public.tb_questionario DROP CONSTRAINT tb_questionario_id_profissao_fkey;
       public          postgres    false    232    234    3309                       2606    16542 +   tb_questionario tb_questionario_id_url_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_questionario
    ADD CONSTRAINT tb_questionario_id_url_fkey FOREIGN KEY (id_url) REFERENCES public.tb_url(id_url);
 U   ALTER TABLE ONLY public.tb_questionario DROP CONSTRAINT tb_questionario_id_url_fkey;
       public          postgres    false    234    3313    236                       2606    16547 5   tb_questionario tb_questionario_id_usuario_criou_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_questionario
    ADD CONSTRAINT tb_questionario_id_usuario_criou_fkey FOREIGN KEY (id_usuario_criou) REFERENCES public.tb_usuario(id_usuario);
 _   ALTER TABLE ONLY public.tb_questionario DROP CONSTRAINT tb_questionario_id_usuario_criou_fkey;
       public          postgres    false    238    3315    234                       2606    16603 (   tb_resposta tb_resposta_id_pergunta_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_resposta
    ADD CONSTRAINT tb_resposta_id_pergunta_fkey FOREIGN KEY (id_pergunta) REFERENCES public.tb_perguntas(id_pergunta);
 R   ALTER TABLE ONLY public.tb_resposta DROP CONSTRAINT tb_resposta_id_pergunta_fkey;
       public          postgres    false    3303    226    242            	           2606    16598 '   tb_resposta tb_resposta_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_resposta
    ADD CONSTRAINT tb_resposta_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tb_usuario(id_usuario);
 Q   ALTER TABLE ONLY public.tb_resposta DROP CONSTRAINT tb_resposta_id_usuario_fkey;
       public          postgres    false    3315    242    238                       2606    16552 $   tb_usuario tb_usuario_id_cidade_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_usuario
    ADD CONSTRAINT tb_usuario_id_cidade_fkey FOREIGN KEY (id_cidade) REFERENCES public.tb_cidade(id_cidade);
 N   ALTER TABLE ONLY public.tb_usuario DROP CONSTRAINT tb_usuario_id_cidade_fkey;
       public          postgres    false    217    238    3293                       2606    16557 *   tb_usuario tb_usuario_id_escolaridade_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_usuario
    ADD CONSTRAINT tb_usuario_id_escolaridade_fkey FOREIGN KEY (id_escolaridade) REFERENCES public.tb_escolaridade(id_escolaridade);
 T   ALTER TABLE ONLY public.tb_usuario DROP CONSTRAINT tb_usuario_id_escolaridade_fkey;
       public          postgres    false    238    219    3295                       2606    16562 '   tb_usuario tb_usuario_id_profissao_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_usuario
    ADD CONSTRAINT tb_usuario_id_profissao_fkey FOREIGN KEY (id_profissao) REFERENCES public.tb_profissao(id_profissao);
 Q   ALTER TABLE ONLY public.tb_usuario DROP CONSTRAINT tb_usuario_id_profissao_fkey;
       public          postgres    false    238    232    3309                       2606    16567 /   tb_usuario_papel tb_usuario_papel_id_papel_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_usuario_papel
    ADD CONSTRAINT tb_usuario_papel_id_papel_fkey FOREIGN KEY (id_papel) REFERENCES public.tb_papel(id_papel);
 Y   ALTER TABLE ONLY public.tb_usuario_papel DROP CONSTRAINT tb_usuario_papel_id_papel_fkey;
       public          postgres    false    3299    240    223                       2606    16572 1   tb_usuario_papel tb_usuario_papel_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_usuario_papel
    ADD CONSTRAINT tb_usuario_papel_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.tb_usuario(id_usuario);
 [   ALTER TABLE ONLY public.tb_usuario_papel DROP CONSTRAINT tb_usuario_papel_id_usuario_fkey;
       public          postgres    false    238    3315    240            �   '   x�3�4�4�L�L�2���,c ��2����=... �      �      x������ � �      �   ,   x�3��uu��Wp���q��,�2�p��B����� �      �      x������ � �      �   ^   x�3�LL����t���%E�)�E
)�
�@Njn"�������������������������!�giqjghq��E��
E��9�Ext��qqq ��7      �      x�3�4�2�4bc 6����� W�      �   �   x���A��0E��)r�
�!	���L�j�(#���먠*R��z~�C<�؜���?r^���)��d{;��#���8����ޗ�ҡ۰�p�k^�5��%=� ���S� �D�'fci�Uc�=�Db~?P�H�`�R��TfR*��-�b���uc��t�⾘����Ǝ�.��lM����v@��)����㺱c�-�&KnQg�b�vucǒ��B�Ƙ}&V      �   �   x����	�0�Rۀ�>W�A�X�%!�Ƥ��RA*pc�!|��O2�Ȥۜg�(���&�/�����YdfJ���FK��ײU']0W�*��{H��^�3x�����T���X�c���G��OA�hȣ���[����^[���f      �      x�3�,(��K�,��W0����� ;*      �   '   x�3��ws��,�2�t	uq�q�b���� ���      �   
  x����j1�ϓ��D�I��KA�޽,��Pt%�>�x��5[�j��"�B!0��C��¸m�%�����b<g8n���qO���k7R��լ�f��(7�9U�h����=�/w_�"����#x"��h��\!8㲷�q��	�W���簬���7Gg/e��!�����R2��P�8z0��W�mL���`��tWZO7�jj�������!�����XA�+�{��6�H����D�LR�H��{J�]� OIV#B��|B      �   )   x�3�4�4�4�,8�8_!%U!)��T04������ � 	m      �   y   x�3��())(���///�K�M����K���K*��Qp�p��s���!����J��3�3RS2����A<}�� ��,IUHIUH�p�ڍ�Ltt��Lc.r���&F��� t�JN      �   m  x������0е��l� �JB� ��B�f6a ���4��;MPթU�����{
HIS�����Ҧ���Y���/������,д��'�4�$�>��Ω�ó�U�fȗ�g�9(B�t����L��4� o�|��TpJ�_��~{�f[�/cY���	�[��'�:�S���T��ѣ!�βf���-�+�	0H���ܽWfUD㚿�}��*u�{�}L���D�l1Ozg�OV��Z+�N�珉��_.����smS��[6榷
��}�01piXE��Jt��I����܌��� �����Rv���2����J�VӖ�ȱ��;&<���^�ƾfɩ-�.W�����VxA�m^�!      �      x������ � �     