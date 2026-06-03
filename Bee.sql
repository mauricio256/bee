SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS Bee;
USE Bee;

-- =========================
-- USERS + PERMISSÕES
-- =========================
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  senha VARCHAR(255),
  telefone VARCHAR(20),
  nivel ENUM('admin','user') DEFAULT 'user',
  ativo TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE permissoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50)
);

CREATE TABLE user_permissoes (
  user_id INT,
  permissao_id INT,
  PRIMARY KEY (user_id, permissao_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (permissao_id) REFERENCES permissoes(id) ON DELETE CASCADE
);

-- =========================
-- CLIENTES / FORNECEDORES
-- =========================
CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150),
  cpf_cnpj VARCHAR(20),
  contato VARCHAR(50),
  endereco TEXT,
  cidade VARCHAR(100),
  estado VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fornecedores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150),
  cnpj VARCHAR(20),
  contato VARCHAR(100),
  telefone VARCHAR(50),
  endereco TEXT,
  cidade VARCHAR(100),
  estado VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- CATEGORIAS
-- =========================
CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100)
);

-- =========================
-- PRODUTOS (COM FISCAL)
-- =========================
CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150),
  descricao TEXT,
  codigo_barras VARCHAR(50) UNIQUE,
  unidade ENUM('un','kg','lt') DEFAULT 'un',
  categoria_id INT,
  
  preco_venda DECIMAL(10,2),
  custo DECIMAL(10,2),
  margem_lucro DECIMAL(5,2),
  
  estoque_minimo INT DEFAULT 0,
  
  -- Fiscal
  ncm VARCHAR(20),
  cfop VARCHAR(10),
  icms DECIMAL(5,2),
  pis DECIMAL(5,2),
  cofins DECIMAL(5,2),
  
  ativo TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- =========================
-- CAIXA
-- =========================
CREATE TABLE caixa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_fechamento TIMESTAMP NULL,
  saldo_inicial DECIMAL(10,2),
  saldo_final DECIMAL(10,2),
  status ENUM('aberto','fechado') DEFAULT 'aberto',
  FOREIGN KEY (usuario_id) REFERENCES users(id)
);

CREATE TABLE caixa_movimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  caixa_id INT,
  usuario_id INT,
  tipo ENUM('entrada','saida'),
  valor DECIMAL(10,2),
  descricao VARCHAR(255),
  tipo_origem ENUM('venda','pagamento','manual'),
  referencia_id INT,
  data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (caixa_id) REFERENCES caixa(id),
  FOREIGN KEY (usuario_id) REFERENCES users(id)
);

-- =========================
-- VENDAS
-- =========================
CREATE TABLE vendas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero_venda VARCHAR(20),
  numero_cupom INT,
  serie VARCHAR(10),
  
  cliente_id INT,
  usuario_id INT,
  caixa_id INT,
  
  subtotal DECIMAL(10,2),
  desconto DECIMAL(10,2),
  total_final DECIMAL(10,2),
  
  tipo ENUM('avista','prazo'),
  status ENUM('aberta','finalizada','cancelada'),
  
  data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (usuario_id) REFERENCES users(id),
  FOREIGN KEY (caixa_id) REFERENCES caixa(id)
);

CREATE TABLE venda_itens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  venda_id INT,
  produto_id INT,
  quantidade DECIMAL(10,3),
  preco_unitario DECIMAL(10,2),
  custo_unitario DECIMAL(10,2),
  subtotal DECIMAL(10,2),
  FOREIGN KEY (venda_id) REFERENCES vendas(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- =========================
-- DEVOLUÇÕES
-- =========================
CREATE TABLE devolucoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  venda_id INT,
  motivo TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (venda_id) REFERENCES vendas(id)
);

-- =========================
-- COMPRAS
-- =========================
CREATE TABLE compras (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fornecedor_id INT,
  usuario_id INT,
  total DECIMAL(10,2),
  status ENUM('pendente','finalizada','cancelada'),
  data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id),
  FOREIGN KEY (usuario_id) REFERENCES users(id)
);

CREATE TABLE compra_itens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  compra_id INT,
  produto_id INT,
  quantidade INT,
  custo_unitario DECIMAL(10,2),
  subtotal DECIMAL(10,2),
  FOREIGN KEY (compra_id) REFERENCES compras(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- =========================
-- ESTOQUE
-- =========================
CREATE TABLE estoque_movimentacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  produto_id INT,
  tipo ENUM('entrada','saida'),
  origem ENUM('venda','compra','ajuste'),
  referencia_id INT,
  quantidade DECIMAL(10,3),
  custo_unitario DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- =========================
-- FINANCEIRO
-- =========================
CREATE TABLE financeiro_lancamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('receita','despesa'),
  origem ENUM('venda','compra','manual'),
  referencia_id INT,
  pessoa_id INT,
  pessoa_tipo ENUM('cliente','fornecedor'),
  descricao TEXT,
  valor DECIMAL(10,2),
  desconto DECIMAL(10,2) DEFAULT 0,
  juros DECIMAL(10,2) DEFAULT 0,
  multa DECIMAL(10,2) DEFAULT 0,
  valor_final DECIMAL(10,2),
  data_vencimento DATE,
  data_pagamento DATE,
  status ENUM('pendente','pago','cancelado'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- PAGAMENTOS
-- =========================
CREATE TABLE pagamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  venda_id INT,
  metodo ENUM('dinheiro','cartao','pix'),
  valor DECIMAL(10,2),
  status ENUM('pendente','pago','cancelado'),
  parcelas INT DEFAULT 1,
  parcela_atual INT DEFAULT 1,
  data_pagamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (venda_id) REFERENCES vendas(id)
);

-- =========================
-- NOTA FISCAL
-- =========================
CREATE TABLE notas_fiscais (
  id INT AUTO_INCREMENT PRIMARY KEY,
  venda_id INT,
  numero VARCHAR(50),
  chave_acesso VARCHAR(100),
  status ENUM('emitida','cancelada','erro'),
  xml TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (venda_id) REFERENCES vendas(id)
);

-- =========================
-- LOGS
-- =========================
CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  modulo VARCHAR(50),
  acao VARCHAR(100),
  descricao TEXT,
  ip VARCHAR(45),
  data_log TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES users(id)
);

-- =========================
-- AUDITORIA
-- =========================
CREATE TABLE auditoria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tabela VARCHAR(50),
  registro_id INT,
  acao ENUM('insert','update','delete'),
  dados_antes JSON,
  dados_depois JSON,
  usuario_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

COMMIT;