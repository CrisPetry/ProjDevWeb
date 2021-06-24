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
codPessoa        serial             not null,
codproduto       serial             not null,
codusuario		 serial             not null,

primary key (codVenda),
foreign key (codPessoa) references PESSOA,
foreign key (codproduto) references PRODUTO,
foreign key (codusuario) references USUARIO
);

