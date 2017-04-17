--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: api; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE api WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Romanian_Moldova.1250' LC_CTYPE = 'Romanian_Moldova.1250';


ALTER DATABASE api OWNER TO postgres;

\connect api

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: transactions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE transactions (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    beneficiary_id bigint NOT NULL,
    value real NOT NULL,
    create_datetime timestamp without time zone NOT NULL,
    create_user bigint NOT NULL
);


ALTER TABLE transactions OWNER TO postgres;

--
-- Name: transactions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE transactions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE transactions_id_seq OWNER TO postgres;

--
-- Name: transactions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transactions_id_seq OWNED BY transactions.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    username character varying(100) NOT NULL,
    id bigint NOT NULL,
    create_datetime timestamp without time zone NOT NULL,
    update_datetime timestamp without time zone NOT NULL,
    create_user bigint,
    update_user bigint,
    admin bigint DEFAULT 0 NOT NULL
);


ALTER TABLE "user" OWNER TO postgres;

--
-- Name: user_balance; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_balance (
    id bigint NOT NULL,
    balance real NOT NULL,
    user_id bigint NOT NULL
);


ALTER TABLE user_balance OWNER TO postgres;

--
-- Name: user_balance_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_balance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_balance_id_seq OWNER TO postgres;

--
-- Name: user_balance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_balance_id_seq OWNED BY user_balance.id;


--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transactions ALTER COLUMN id SET DEFAULT nextval('transactions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY user_balance ALTER COLUMN id SET DEFAULT nextval('user_balance_id_seq'::regclass);


--
-- Data for Name: transactions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY transactions (id, user_id, beneficiary_id, value, create_datetime, create_user) FROM stdin;
3	18	14	100	2017-04-13 13:48:24	18
4	18	14	1232	2017-04-13 13:56:21	18
5	14	18	100	2017-04-13 14:02:48	14
6	14	18	123	2017-04-13 15:09:51	14
\.


--
-- Name: transactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transactions_id_seq', 6, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "user" (username, id, create_datetime, update_datetime, create_user, update_user, admin) FROM stdin;
vanea	15	2017-04-12 16:12:50	2017-04-12 16:12:50	14	14	0
startrek	14	2017-04-12 16:12:38	2017-04-12 16:12:38	\N	\N	1
Sadasdasd	16	2017-04-13 12:53:36	2017-04-13 12:53:36	\N	\N	0
sasdas	17	2017-04-13 12:54:45	2017-04-13 12:54:45	\N	\N	0
admin	18	2017-04-13 13:41:40	2017-04-13 13:41:40	\N	\N	0
\.


--
-- Data for Name: user_balance; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_balance (id, balance, user_id) FROM stdin;
9	0	16
10	0	17
8	0	15
11	-1109	18
7	1109	14
\.


--
-- Name: user_balance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_balance_id_seq', 11, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 18, true);


--
-- Name: transactions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY transactions
    ADD CONSTRAINT transactions_pkey PRIMARY KEY (id);


--
-- Name: user_balance_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_balance
    ADD CONSTRAINT user_balance_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: transactions_beneficiary_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transactions
    ADD CONSTRAINT transactions_beneficiary_id_fkey FOREIGN KEY (beneficiary_id) REFERENCES "user"(id);


--
-- Name: transactions_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transactions
    ADD CONSTRAINT transactions_user_id_fkey FOREIGN KEY (user_id) REFERENCES "user"(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

