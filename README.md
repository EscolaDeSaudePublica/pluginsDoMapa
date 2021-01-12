# Plugins do Mapa da Saúde
Repositório de plugins desenvolvido pela ESP do decorrer do desenvolvimento do Mapa da Saúde.

Esse repositório é destinado para todos desenvolvedores que queiram utilizar dos nossos plugins.
Todos os plugins aqui nesse repositório foram feitos um PULL REQUEST para o repositório oficial do [mapas culturais](https://github.com/mapasculturais), se encontrar nesse repositório e não encontrar no repositórios deles, é por que ainda deve ser aprovado o PR ou está em análise.

# Regras.

Todos os plugins deve obdecer a estrutura desenvolvida e aceita dentro da aplicação do mapas como mostra nesse [link](https://github.com/mapasculturais/mapasculturais-base-project/tree/master/plugins)

Todo plugin deve está dentro de uma pasta que tem o nome do plugin.

## Como instalar
- Dentro do seu tema deve está configurado todos os plugins que o seu projeto está usando, caso contrário, poderá criar ou adicionar no seu arquivo chamado conf-base.php com o seguinte trecho de código.
```
'plugins' => [
  'ProjectPhases' => ['namespace' => 'ProjectPhases'],
  'AgendaSingles' => ['namespace' => 'AgendaSingles']
]
```

- Clonar do repositório o plugin que deseja utilizar


### Obs: Seguir o documento do repositório oficial do Mapas da Cultura
https://github.com/mapasculturais/mapasculturais/blob/develop/documentation/docs/mc_config_plugins.md
