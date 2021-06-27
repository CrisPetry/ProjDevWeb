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