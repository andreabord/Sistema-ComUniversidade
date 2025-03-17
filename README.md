# Sistema ComUniversidade
O ComUniversidade tem o objetivo principal de conectar a sociedade e a universidade, promovendo maior interação entre ambas as partes. Desse modo, o sistema busca garantir que o conhecimento produzido por servidores e alunos através de ações de extensão universitária, chegue de maneira efetiva até a comunidade. Da mesma forma, possibilitando que as necessidades enfrentadas pela sociedade também sejam comunicadas para as universidades, facilitando assim a interação e, consequentemente, a criação de ações de extensão cada vez mais alinhadas com a realidade.

Este sistema busca apoiar as Instituições de Ensino Superior (IES), auxiliando-as no estabelecimento de relações mais próximas entre a comunidade universitária e os diversos setores da sociedade. Por meio da criação do sistema proposto, será possível que as ações de extensão das IES não apenas enriqueçam os currículos dos cursos, mas também atendam às necessidades expressas pela sociedade.


### Visão geral
Os usuários do sistema são diferenciados em 3 tipos:

- Servidores: Professores e técnicos administrativos da universidade.
- Estudantes: Alunos regularmente matriculados nos cursos da instituição.
- Membros Externos: Pessoas ou organizações da comunidade que interagem com a universidade.

O sistema permite que membros da comunidade externa cadastrem demandas que pedem ser supridas pelos servidores, e servidores podem cadastrar ofertas que ajudem a comunidade externa. As demandas e ofertas são mostradas para o usuário seguindo o algoritmo de Ratcliff-Obershelp, que analisa a similaridade entre as strings dos títulos e descrição de uma demanda em relação a uma oferta. A pontuação final de similaridade é definida por:

**pontuação final = pontuação dos títulos * 0.7 + pontuação das descrições * 0.3**

Os matchings só ocorrem quando porcentagem de similaridade total é maior que 50%.

# Informações sobre o sistema
### Tecnologias Utilizadas
- 🐘 PHP v.8.2.18
- 🔥 Laravel v.10.37.2
- 🐬 MySQL v.8.0.36

# Sistema ComUniversidade com Docker
Este sistema foi desenvolvido utilizando o framework Laravel, um dos mais populares para aplicações web em PHP. Ele está totalmente containerizado com Docker, garantindo uma configuração padronizada e facilidade de implantação. Além disso, um banco de dados MySQL é utilizado para armazenar as informações da aplicação, com suporte ao phpMyAdmin para gerenciamento visual.

### Como configurar e executar o sistema

> ⚠️ **Observação:**  
> Para configurar o envio de e-mails de reset de senha é necessário gerar as credencias do OAuth 2.0 em [Google Cloud Console](https://console.cloud.google.com/).
> Defina a URI de redirecionamento como `http://localhost:8000/callback` e adicione o ID do cliente, a chave secreta, o URI de redirecionamento e o e-mail de uso nas variáveis de ambiente (arquivo .env.example ou adicione ao container Docker caso já tenho feito o build):
> - `GOOGLE_CLIENT_ID`
> - `GOOGLE_CLIENT_SECRET`
> - `GOOGLE_REDIRECT_URI`
> - `MAIL_USERNAME`
> - `MAIL_FROM_ADDRESS`
> Depois acesse http://localhost:8000/callback para autorizar o uso.
> Após isso, o envio deve estar funcionando normalmente.
>
> Não configurar o envio de e-mail não afeta o funcionamento do sistema, só não vai ser possível enviar e-mails.

1. Certfique-se de ter instalado o Docker e o Docker Compose.
2. Clone o repositório

```sh
git clone https://github.com/andreabord/Sistema-ComUniversidade.git
cd Sistema-ComUniversidade
```

3. Contrua e inicialize os containers
```sh
docker-compose up -d --build
```

4. Acesse o sistema em:
- Sistema ComUniversidade: http://localhost:8000
- phpMyAdmin: http://localhost:8080
    - Usuário: root
    - Senha: 4SNMkW1lPG34

### Desenvolvido por
- *Guilherme Oliveira de Sá Cabrera*

### Orientado por
- *Andréa Sabedra Bordin*

### Manutenção
- *Julia Pereira*
