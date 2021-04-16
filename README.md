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
Você deve adicionar mais um indice no seu array de plugins
``` 
  'LocationStateCity' => [
      'namespace' => 'LocationStateCity'
  ],
```

### Obs 01: Seguir o documento do repositório oficial do Mapas da Cultura
https://github.com/mapasculturais/mapasculturais/blob/develop/documentation/docs/mc_config_plugins.md

### Obs 02: Renomeando o clone
- Clonar do repositório o plugin que deseja utilizar dentro da pasta *plugins* que fica em src/protected/application/

Ao clonar o repositório irá baixar todos os plugins, portanto poderá fazer os seguintes comandos:
1 - Para clocar com o nome do plugin desejavo
```
git clone https://github.com/EscolaDeSaudePublica/pluginsDoMapa.git --recursive
```
Acessa o repositório do clone com
```
cd pluginsDoMapa
``` 
Remove o seu plugin desejado do repositório e coloca o mesmo na sua aplicação, como por exemplo 
```
mv LocationStateCity/ ../
```
Se desejar o plugin de LocationStateCity

Você também poderá remover o repositório com o seguinte comando, pois haverá outros plugins que queira usar.
```
cd ..
sudo rm -R pluginsDoMapa/
``` 
Cada Plugin está em uma branch específica e para baixar o seu plugin desejado você deve digitar o seguinte código:
```
git clone -b <branch> < remote_repo >
```
Por exemplo: 
```
git clone -b  PDFReport  https://github.com/EscolaDeSaudePublica/pluginsDoMapa.git
```

