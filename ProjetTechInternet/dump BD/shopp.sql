--
-- PostgreSQL database dump
--

-- Dumped from database version 14.6
-- Dumped by pg_dump version 15.1

-- Started on 2023-05-27 14:13:26

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 3374 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 218 (class 1255 OID 65613)
-- Name: ajout_categorie(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_categorie(text) RETURNS integer
    LANGUAGE plpgsql
    AS '
  
  declare p_nom_cat alias for $1;
  declare id integer;
  declare retour integer;
begin
  select into id id_categorie from categorie where nom_cat = p_nom_cat;
  if not found
  then
	insert into categorie (nom_cat) values (p_nom_cat);
	select into id id_categorie from categorie where nom_cat = p_nom_cat;
	if not found
	then
	  retour = -1; -- échec insertion
	else
	  retour = 1; -- insertion OK
	end if;
  else
    retour = 0; -- déja en BD
  end if;
  return retour;
  end;';


--
-- TOC entry 222 (class 1255 OID 65614)
-- Name: ajout_produit(text, double precision, text, integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_produit(p_libelle text, p_prix double precision, p_illustration text, p_qstock integer, p_id_categorie integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_prod INTEGER;
  retour INTEGER;
BEGIN
  id_prod := NULL;
  
  SELECT id_produit INTO id_prod 
  FROM produits 
  WHERE libelle = p_libelle AND id_categorie = p_id_categorie;
  
  IF id_prod IS NULL THEN
    INSERT INTO produits (libelle, prix, illustration, qstock, id_categorie)
    VALUES (p_libelle, p_prix, p_illustration, p_qstock, p_id_categorie)
    RETURNING id_produit INTO id_prod;
    
    IF id_prod IS NULL THEN
      retour := 0; -- Échec de linsertion
    ELSE
      retour := 1; -- Insertion réussie
    END IF;
  ELSE
    retour := 0; -- Produit déjà présent
  END IF;
  
  RETURN retour;
END;
';


--
-- TOC entry 223 (class 1255 OID 65615)
-- Name: effacer_produit(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.effacer_produit(f_id_produit integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_produit INTEGER;
BEGIN
  DELETE FROM produits WHERE id_produit = f_id_produit;
  
  RETURN 1;
END;
';


--
-- TOC entry 234 (class 1255 OID 65622)
-- Name: getadmin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.getadmin(p_login text, p_pass text) RETURNS integer
    LANGUAGE plpgsql
    AS '
 
DECLARE
  id_adm INTEGER;
  retour INTEGER;
BEGIN
  SELECT id_admin INTO id_adm FROM administrateur WHERE login = p_login AND password = p_pass;
  
  IF NOT FOUND THEN
    retour = 0;
  ELSE
    retour = 1;
  END IF;
  
  RETURN retour;
END;
';


--
-- TOC entry 236 (class 1255 OID 65624)
-- Name: isadmin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.isadmin(p_login text, p_password text) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_adm INTEGER;
  retour INTEGER;
BEGIN
  SELECT id_admin INTO id_adm FROM administrateur WHERE login = p_login AND password = p_password;
  
  IF NOT FOUND THEN
    retour = 0;
  ELSE
    retour = 1;
  END IF;
  
  RETURN retour;
END;
';


--
-- TOC entry 232 (class 1255 OID 65616)
-- Name: modifier_produit(integer, text, integer, double precision, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifier_produit(f_id_produit integer, f_nom_produit text, f_id_categorie integer, f_prix double precision, f_illustration text) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_produit INTEGER;
  retour INTEGER;
BEGIN
  SELECT id_produit INTO id_produit FROM produits WHERE id_produit = f_id_produit;
  
  IF NOT FOUND THEN
    retour = 0; -- Le produit nexiste pas
  ELSE
    UPDATE produits
    SET libelle = f_nom_produit,
        id_categorie = f_id_categorie,
        prix = f_prix,
        illustration = f_illustration
    WHERE id_produit = f_id_produit;
    
    retour = 1; -- Modification réussie
  END IF;
  
  RETURN retour;
END;
';


--
-- TOC entry 233 (class 1255 OID 65617)
-- Name: modifier_produit(integer, text, integer, double precision, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifier_produit(f_id_produit integer, f_nom_produit text, f_id_categorie integer, f_prix double precision, f_illustration text, f_qstock integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_prod INTEGER;
  retour INTEGER;
BEGIN
  SELECT id_produit INTO id_prod FROM produits WHERE id_produit = f_id_produit;
  
  IF NOT FOUND THEN
    retour = 0; -- Le produit nexiste pas
  ELSE
    UPDATE produits
    SET libelle = f_nom_produit,
        id_categorie = f_id_categorie,
        prix = f_prix,
        illustration = f_illustration,
        qstock = f_qstock
    WHERE id_produit = f_id_produit;
    
    retour = 1; -- Modification réussie
  END IF;
  
  RETURN retour;
END;
';


--
-- TOC entry 235 (class 1255 OID 65623)
-- Name: raisenotice(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.raisenotice() RETURNS integer
    LANGUAGE plpgsql
    AS '
begin
  raise exception ''exception'';
  return 1;
end;

';


--
-- TOC entry 237 (class 1255 OID 65625)
-- Name: verifier_connexion(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.verifier_connexion(f_login text, f_password text) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
  id_adm INTEGER;
  retour INTEGER;
BEGIN
  SELECT id_admin INTO id_adm FROM administrateur WHERE login = f_login AND password = f_password;
  
  IF NOT FOUND THEN
    retour = 0;
  ELSE
    retour = 1;
  END IF;
  
  RETURN retour;
END;
';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 209 (class 1259 OID 65537)
-- Name: administrateur; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.administrateur (
    id_admin integer NOT NULL,
    login text,
    prenom_admin text,
    email text,
    password text
);


--
-- TOC entry 212 (class 1259 OID 65563)
-- Name: categorie; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categorie (
    id_categorie integer NOT NULL,
    nom_cat text NOT NULL
);


--
-- TOC entry 214 (class 1259 OID 65571)
-- Name: client; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.client (
    id_client integer NOT NULL,
    nom_client text,
    prenom_client text,
    mail text,
    motdepasse text,
    nom_rue text,
    num_rue integer NOT NULL,
    id_ville integer NOT NULL
);


--
-- TOC entry 213 (class 1259 OID 65570)
-- Name: client_num_rue_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.client_num_rue_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3375 (class 0 OID 0)
-- Dependencies: 213
-- Name: client_num_rue_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.client_num_rue_seq OWNED BY public.client.num_rue;


--
-- TOC entry 216 (class 1259 OID 65596)
-- Name: commande; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.commande (
    id_com integer NOT NULL,
    datecom text,
    cout double precision NOT NULL,
    qtecom integer NOT NULL,
    id_produit integer NOT NULL,
    id_client integer NOT NULL
);


--
-- TOC entry 210 (class 1259 OID 65544)
-- Name: pays; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.pays (
    id_pays integer NOT NULL,
    nom_pays text
);


--
-- TOC entry 215 (class 1259 OID 65584)
-- Name: produits; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produits (
    id_produit integer NOT NULL,
    libelle text,
    prix double precision NOT NULL,
    illustration text,
    qstock integer,
    id_categorie integer NOT NULL
);


--
-- TOC entry 211 (class 1259 OID 65551)
-- Name: ville; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ville (
    id_ville integer NOT NULL,
    nom_ville text NOT NULL,
    code_postal text,
    id_pays integer NOT NULL
);


--
-- TOC entry 217 (class 1259 OID 65618)
-- Name: vue_produits; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_produits AS
 SELECT produits.id_produit,
    produits.libelle,
    produits.illustration,
    produits.prix,
    produits.qstock,
    produits.id_categorie,
    categorie.nom_cat
   FROM (public.produits
     JOIN public.categorie ON ((produits.id_categorie = categorie.id_categorie)));


--
-- TOC entry 3201 (class 2604 OID 65574)
-- Name: client num_rue; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client ALTER COLUMN num_rue SET DEFAULT nextval('public.client_num_rue_seq'::regclass);


--
-- TOC entry 3361 (class 0 OID 65537)
-- Dependencies: 209
-- Data for Name: administrateur; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.administrateur (id_admin, login, prenom_admin, email, password) VALUES (1, 'admin', NULL, NULL, '21232f297a57a5a743894a0e4a801fc3');


--
-- TOC entry 3364 (class 0 OID 65563)
-- Dependencies: 212
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.categorie (id_categorie, nom_cat) VALUES (1, 'multimedia');


--
-- TOC entry 3366 (class 0 OID 65571)
-- Dependencies: 214
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client (id_client, nom_client, prenom_client, mail, motdepasse, nom_rue, num_rue, id_ville) VALUES (1, 'dufour', 'laure', 'lauredufour@gmail.com', '1234', 'rue des arquebusiers', 5, 1);


--
-- TOC entry 3368 (class 0 OID 65596)
-- Dependencies: 216
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.commande (id_com, datecom, cout, qtecom, id_produit, id_client) VALUES (1, '27/05/2023', 15, 1, 1, 1);


--
-- TOC entry 3362 (class 0 OID 65544)
-- Dependencies: 210
-- Data for Name: pays; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.pays (id_pays, nom_pays) VALUES (1, 'belgique');


--
-- TOC entry 3367 (class 0 OID 65584)
-- Dependencies: 215
-- Data for Name: produits; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (1, 'imprimante', 15, 'imprimante.jpg', 10, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (2, 'samsungtab', 100, 'samsungtab.jpg', 50, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (3, 'apple', 1000, 'apple.jpg', 50, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (4, 'asus', 2000, 'asus.jpg', 50, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (5, 'cable', 20, 'cable.jpg', 10, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (6, 'casque', 50, 'casque.jpg', 100, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (7, 'earpod', 30, 'earpod.jpg', 150, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (8, 'ecouteur', 100, 'ecouteur.jpg', 200, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (9, 'ecran', 500, 'ecran.jpg', 200, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (10, 'iPad', 1000, 'iPad.jpg', 20, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (11, 'manette', 50, 'manette.jpg', 25, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (12, 'pc', 5000, 'pc.jpg', 55, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (13, 'poco', 500, 'poco.jpg', 70, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (14, 'ps', 500, 'ps.jpg', 100, 1);
INSERT INTO public.produits (id_produit, libelle, prix, illustration, qstock, id_categorie) VALUES (15, 'xbox', 500, 'xbox.jpg', 90, 1);


--
-- TOC entry 3363 (class 0 OID 65551)
-- Dependencies: 211
-- Data for Name: ville; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.ville (id_ville, nom_ville, code_postal, id_pays) VALUES (1, 'mons', '7000', 1);


--
-- TOC entry 3376 (class 0 OID 0)
-- Dependencies: 213
-- Name: client_num_rue_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_num_rue_seq', 1, false);


--
-- TOC entry 3203 (class 2606 OID 65543)
-- Name: administrateur administrateur_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.administrateur
    ADD CONSTRAINT administrateur_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 3209 (class 2606 OID 65569)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_categorie);


--
-- TOC entry 3211 (class 2606 OID 65578)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 3215 (class 2606 OID 65602)
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_com);


--
-- TOC entry 3205 (class 2606 OID 65550)
-- Name: pays pays_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.pays
    ADD CONSTRAINT pays_pkey PRIMARY KEY (id_pays);


--
-- TOC entry 3213 (class 2606 OID 65590)
-- Name: produits produits_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produits
    ADD CONSTRAINT produits_pkey PRIMARY KEY (id_produit);


--
-- TOC entry 3207 (class 2606 OID 65557)
-- Name: ville ville_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_pkey PRIMARY KEY (id_ville);


--
-- TOC entry 3217 (class 2606 OID 65579)
-- Name: client client_id_ville_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_id_ville_fkey FOREIGN KEY (id_ville) REFERENCES public.ville(id_ville);


--
-- TOC entry 3219 (class 2606 OID 65608)
-- Name: commande commande_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 3220 (class 2606 OID 65603)
-- Name: commande commande_id_produit_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_id_produit_fkey FOREIGN KEY (id_produit) REFERENCES public.produits(id_produit);


--
-- TOC entry 3218 (class 2606 OID 65591)
-- Name: produits produits_id_categorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produits
    ADD CONSTRAINT produits_id_categorie_fkey FOREIGN KEY (id_categorie) REFERENCES public.categorie(id_categorie);


--
-- TOC entry 3216 (class 2606 OID 65558)
-- Name: ville ville_id_pays_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_id_pays_fkey FOREIGN KEY (id_pays) REFERENCES public.pays(id_pays);


-- Completed on 2023-05-27 14:13:29

--
-- PostgreSQL database dump complete
--

