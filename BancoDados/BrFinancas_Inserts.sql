INSERT INTO `tb_imagem` (`co_imagem`, `ds_caminho`) VALUES
(1, 'leonardo-m-c-bessa-56e8920c23ab6.jpg');

INSERT INTO `tb_contato` (`co_contato`, `nu_tel1`, `nu_tel2`, `nu_tel3`, `ds_email`) VALUES
(1, '61993274991', '6130826060', NULL, 'leonardomcbessa@gmail.com');

INSERT INTO `tb_endereco` (`co_endereco`, `ds_endereco`, `ds_complemento`, `ds_bairro`, `nu_cep`, `no_cidade`, `sg_uf`) VALUES
(1, 'qr 403 conjunto 10 casa 28', NULL, 'Samambaia Norte', '72319111', 'Brasília', 'DF');

INSERT INTO `tb_pessoa` (`co_pessoa`, `nu_cpf`, `no_pessoa`, `nu_rg`, `dt_cadastro`, `dt_nascimento`, `st_sexo`, `co_endereco`, `co_contato`) VALUES
(1, '72681438187', 'Leonardo Machado Carvalho Bessa', '2077811', '2016-10-31 00:00:00', '1984-07-06', 'M', 1, 1);

INSERT INTO `tb_funcionalidade` (`co_funcionalidade`, `no_funcionalidade`, `ds_rota`, `st_status`) VALUES
(1, 'Perfil Master', 'Admin/Index/SuperPerfil', 'A'),
(2, 'Auditoria Listar', 'Admin/Auditoria/ListarAuditoria', 'A'),
(3, 'Auditoria Detalhar', 'Admin/Auditoria/DetalharAuditoria', 'A'),
(4, 'Usuario Cadastrar', 'Admin/Usuario/CadastroUsuario', 'A'),
(5, 'Usuario Listar', 'Admin/Usuario/ListarUsuario', 'A'),
(6, 'Meu Usuario', 'Admin/Usuario/MeuPerfilUsuario', 'A'),
(7, 'Perfil Listar', 'Admin/Perfil/ListarPerfil', 'A'),
(8, 'Perfil Cadastrar', 'Admin/Perfil/CadastroPerfil', 'A'),
(9, 'Funcionalidade Listar', 'Admin/Funcionalidade/ListarFuncionalidade', 'A'),
(10, 'Funcionalidade Cadastrar', 'Admin/Funcionalidade/CadastroFuncionalidade', 'A'),
(11, 'Funcionalidades Perfil', 'Admin/Funcionalidade/FuncionalidadesPerfil', 'A');


INSERT INTO `tb_perfil` (`co_perfil`, `no_perfil`, `st_status`) VALUES
(1, 'Master', 'A'),
(2, 'Coordenador', 'A'),
(3, 'Membro', 'A');

INSERT INTO `tb_perfil_funcionalidade` (`co_perfil_funcionalidade`, `co_perfil`, `co_funcionalidade`) VALUES
(1, 1, 1),
(2, 2, 5),
(3, 2, 6),
(4, 3, 6);

INSERT INTO `tb_tipo_pagamento` (`co_tipo_pagamento`, `ds_tipo_pagamento`, `sg_tipo_pagamento`) VALUES
(1, 'Dinheiro', 'DI'),
(2, 'Cartão de Crédito', 'CC');

INSERT INTO `tb_usuario` (`co_usuario`, `ds_senha`, `ds_code`, `st_status`, `dt_cadastro`, `co_imagem`, `co_pessoa`) VALUES
(1, '123456**', 'TVRJek5EVTJLaW89', 'A', '2016-10-31 00:00:00', 1, 1);

INSERT INTO `tb_usuario_perfil` (`co_usuario_perfil`, `co_usuario`, `co_perfil`) VALUES
(1, 1, 1);