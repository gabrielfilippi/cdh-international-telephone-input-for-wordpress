=== CodeHive - International Telephone Number for Wordpress ===

## Descrição
Adiciona suporte para telefones internacionais nos campos de telefone do WordPress e WooCommerce usando a biblioteca "International Telephone Input".

## Instalação
1. Faça o upload do plugin para o diretório `/wp-content/plugins/` ou instale o plugin diretamente através da tela de plugins do WordPress.
2. Ative o plugin através da tela 'Plugins' no WordPress.
3. Configure as opções do plugin na página de configurações, se necessário.

## Perguntas Frequentes

= Como o plugin funciona? =
O plugin localiza os campos de telefone no WordPress e WooCommerce e adiciona a funcionalidade de telefone internacional utilizando a biblioteca "International Telephone Input".

= O plugin é compatível com todos os temas? =
O plugin deve funcionar com a maioria dos temas que seguem os padrões do WordPress. Caso encontre algum problema, por favor, entre em contato conosco.

= Tenho um campo customizado de telefone que não é padrão do Woocommerce, como faço para que fique no padrão internacional?
Adicione o código abaixo no arquivo wp-config.php:

```php
// para campos customizados no endereço de faturamento (billing)
define(
	"CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS",
	array( 
		array( 
			"name" => "MEU_CAMPO_CUSTOMIZADO",
			"is_private" => true
		),
	)
);

// para campos customizados no endereço de entrega (shipping)
define(
	"CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS",
	array( 
		array( 
			"name" => "MEU_CAMPO_CUSTOMIZADO",
			"is_private" => true
		),
	)
);
```
Substitua "MEU_CAMPO_CUSTOMIZADO" pelo nome do seu campo customizado. O parâmetro "is_private" deve ser definido como true se o campo for privado, caso contrário, defina como false.

## Contribuição

Se você deseja contribuir para o desenvolvimento do plugin, siga estas etapas:

1. Faça um fork do repositório no GitHub.
2. Crie um branch para suas alterações: `git checkout -b nome-da-sua-feature`.
3. Faça as alterações desejadas e adicione os arquivos modificados: `git add .`.
4. Faça o commit das suas alterações: `git commit -m "Nome da sua feature"`.
5. Faça o push para o branch: `git push origin nome-da-sua-feature`.
6. Envie um pull request para o repositório NotifyMe.

## Suporte

Se você encontrar algum problema ou tiver alguma dúvida relacionada ao plugin, recomendamos que você abra uma issue no repositório oficial do GitHub. Siga as etapas abaixo para abrir uma nova issue:

1. Acesse a página de [Issues](https://github.com/gabrielfilippi/cdh-International-Telephone-Input-for-Wordpress/issues).
2. Clique no botão "New Issue".
3. Preencha o título da issue de forma clara e concisa, descrevendo o problema ou a dúvida que você encontrou.
4. Na caixa de descrição, forneça informações detalhadas sobre o problema ou a dúvida, incluindo passos reproduzíveis, se aplicável.
5. Clique em "Submit new issue" para criar a issue.

Nosso time de desenvolvedores estará pronto para ajudar e responder às suas questões o mais rápido possível. Agradecemos seu interesse e contribuição para melhorar o NotifyMe!

**Note:** Certifique-se de verificar se a sua dúvida ou problema já foi relatado anteriormente antes de abrir uma nova issue, para evitar duplicações.

## Contribuição Monetária

Agradecemos pelo seu interesse em contribuir para o desenvolvimento contínuo do plugin! Se você acredita que nosso trabalho é valioso e deseja apoiar ainda mais a melhoria e manutenção do plugin, agora você tem a oportunidade de fazer uma contribuição monetária.

Suas contribuições financeiras nos ajudam a dedicar mais tempo e recursos para implementar novos recursos, aprimorar a estabilidade e fornecer suporte ágil aos usuários. Com o seu apoio, podemos continuar oferecendo um plugin de alta qualidade que atende às necessidades das lojas virtuais baseadas em Woocommerce.

PIX (Copia e Cole): 1c39d3bd-6ea6-49d2-9674-ac622349516b

Agradecemos sinceramente por considerar fazer uma contribuição. Sua generosidade e apoio financeiro nos ajudam a continuar oferecendo um plugin funcional e atualizado.

Obrigado novamente por seu apoio contínuo!

## Licença

Este plugin é licenciado sob a [GPL-2.0+](http://www.gnu.org/licenses/gpl-2.0.txt).
