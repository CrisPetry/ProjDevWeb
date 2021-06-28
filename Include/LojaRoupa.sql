CREATE TABLE USUARIO(
id 	        	serial 		    not null,
apelido        	text         	not null,
senha          	char(32)  		not null,
 
primary key (id)
);

CREATE TABLE PRODUTO(
codProduto	serial		not null,
descricao	text		not null,
estoque	    integer 	not null,

primary key (codProduto)
);

CREATE TABLE PESSOA (
id             serial         not null, 
nome		   text	          not null, 
numsoc         varchar(20)    not null, 
endereco       text        	  not null, 
telefone       varchar(20)    not null,
cidade		   text		      not null,

primary key (id)
);


CREATE TABLE VENDA(
codVenda       	 serial	            not null, 
data          	 varchar(20)        not null, 
valorTotal       float              not null, 
qtd              integer            not null,
codPessoa        serial             not null,
idproduto        serial             not null,
codusuario		 serial             not null,

primary key (codVenda),
foreign key (codPessoa) references PESSOA,
foreign key (idproduto) references PRODUTO(codProduto),
foreign key (codusuario) references USUARIO
);

--trigger estoque--
create trigger t_atualiza_estoque
before insert on venda
for each row
execute procedure atualiza_estoque();

--function estoque--
create or replace function atualiza_estoque() returns trigger
as
$$
declare
	qtde integer;
begin 
	select estoque from produto where codproduto = new.idproduto into qtde;
	if qtde < new.qtd then
		raise exception 'Quantidade indisponível em estoque.';
	else
		update produto set estoque = estoque - new.qtd
			where codproduto = new.idproduto;
	end if;
	return new;
end
$$ language plpgsql;


-- TABLE PRODUTO --

INSERT INTO produto VALUES
(Default, 'Calça Jeans', 25),	
(Default, 'Calça Sarja', 12),
(Default, 'Calça Moletom', 10),
(Default, 'Camiseta Polo', 100),
(Default, 'Luvas de inverno', 25),
(Default, 'Gorro', 5),
(Default, 'Camisa Social', 30),
(Default, 'Bermuda Brin', 50),
(Default, 'Paletó', 23),
(Default, 'Saia', 11),
(Default, 'Cardigã', 26);


-- TABLE PESSOA --

INSERT INTO pessoa VALUES
(Default, 'Luna Nair das Neves', '071.977.611-23', 'Rua Principal, s/n', '(84) 98870-1094', 'Boa Saúde/RN'),	
(Default, 'Vicente Davi Martins', '945.066.008-51', 'Rua Cinqüenta e Dois, 264', '(79) 99721-3017', 'Aracaju/SE'),
(Default, 'João Márcio Samuel das Neves', '820.133.151-63', 'Rua Augusto Vieira Jacques, 898', '(21) 99468-0636', 'Niterói/RJ'),
(Default, 'Cecília Elisa Bárbara Rocha', '658.248.975-57', 'Rua Cassiterita, 356', '(95) 99521-0101', 'Boa Vista/RR'),
(Default, 'Alessandra Jennifer Helena Fogaça', '974.185.396-30', 'Avenida Anchieta, 410', '(49) 99498-2773', 'Anchieta/SC'),
(Default, 'Samuel Mateus Pedro Caldeira', '303.386.069-98', 'Rua Florianópolis, 167', '(21) 99969-6447', 'Nova Iguaçu/RJ'),
(Default, 'Rosa Olivia Hadassa da Paz', '511.108.655-20', 'Alameda dos Flamboyants, 436', '(81) 98325-5517', 'São Lourenço da Mata/PE'),
(Default, 'Marli Gabriela Nogueira', '621.986.494-89', 'Rua das Oliveiras, 239', '(84) 98108-6575', 'Parnamirim/RN'),
(Default, 'Henry Sérgio Juan Campos', '305.382.867-76', 'Avenida Rodrigo Otávio, 506', '(92) 99399-3592', 'Manaus/AM'),
(Default, 'Larissa Beatriz Isabella Oliveira', '775.668.251-35', 'Alameda dos Jasmins, 491', '(96) 98577-1680', 'Santana/AP');


-- TABLE USUARIO -- 

INSERT INTO usuario VALUES
(Default, 'Nekaun', MD5('LSn3E3')),	
(Default, 'Ruteas', MD5('aYiPh2')),
(Default, 'Moikin', MD5('E25isR')),
(Default, 'Vucopa', MD5('FPDwYi')),
(Default, 'Hoyrur', MD5('aEFzGL')),
(Default, 'Fioses', MD5('WRe9Lj')),
(Default, 'Goenxo', MD5('3l7b2e')),
(Default, 'Urxuis', MD5('S7XOgF')),
(Default, 'Vukyol', MD5('hlUkXt')),
(Default, 'Meyces', MD5('JxzOm5'));
