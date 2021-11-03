CREATE TABLE mercados (
  id_mercado INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome_mercado VARCHAR(50) NOT NULL,
  local_mercado VARCHAR(255) NULL,
  site_mercado VARCHAR(255) NULL,
  PRIMARY KEY(id_mercado)
);

CREATE TABLE ofertas (
  mercados_id_mercado INTEGER UNSIGNED NOT NULL,
  produtos_id_produto INTEGER UNSIGNED NOT NULL,
  id_oferta INTEGER UNSIGNED NOT NULL,
  preco_oferta FLOAT NOT NULL,
  comentario_oferta VARCHAR(500) NULL,
  PRIMARY KEY(mercados_id_mercado, produtos_id_produto),
  INDEX mercados_has_produtos_FKIndex1(mercados_id_mercado),
  INDEX mercados_has_produtos_FKIndex2(produtos_id_produto)
);

CREATE TABLE produtos (
  id_produto INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome_produto VARCHAR(50) NOT NULL,
  qtd_produto INTEGER UNSIGNED NULL,
  PRIMARY KEY(id_produto)
);


