<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NewsCard
 */

get_header();

	newscard_layout_primary(); ?>
		<main id="main" class="site-main">
      <div class="page type-page status-publish hentry">
        <header class="entry-header">
          <h1 class="entry-title">Ergue-te 2022</h1>
        </header><!-- .entry-header -->
        <div class="entry-content">
          <a href="https://forms.gle/b3zJsViKu4xyebDG8" target="_blank">
            <figure class="wp-block-image size-large">
              <img 
                width="1024" 
                height="1024" 
                src="<?= get_home_url() ?>/wp-content/themes/newscard/assets/image/ergue-te-2022.jpeg" 
                alt="" 
                class="wp-image-300"
              >
            </figure>
          </a>
          <div class="quote">
            <div class="testimonial">
              <div class="icon">
                <i class="fa fa-wpforms"></i>
              </div>
              <a href="https://forms.gle/b3zJsViKu4xyebDG8" target="_blank">Formulário de inscrição</a>
              <p class="text-testimonial">Garanta já sua vaga</p>
            </div>

            <p class="text-quote">
              Primeiro Lote durante todo o mês de Março<br>
              Valores Promocionais: 
              <ul>
                <li>Uma pessoa: R$50,00</li>
                <li>Três pessoas: R$120,00</li>
              </ul>
            </p>
            <p class="text-quote">
              FORMAS DE PAGAMENTO:
              <ul>
                <li>Pix ( Celular: 79998464275- Giuliana Victória Santos )</li>
                <li>
                  Cartão ( Exceto Banese )
                  <ul>
                    <li>Obs: Consultar as Taxas com 79998464275 - Giuliana</li>
                  </ul>
                </li>
                <li>Boleto ( Até 3 dias de vencimento )</li>
                <li>
                  Espécie ( Entrar em contato com o membro de sua comunidade)
                  <ul>
                    <li>79 998464275 - Giuliana ( Matriz )</li>
                    <li>79 998157873 - Luzia ( Bom Pastor )</li>
                    <li>79 981186010 - Kelly ( São José )</li>
                    <li>79 988640549 - Kauan ( Nossa Senhora da Conceição)</li>
                    <li>79 988680849 - Larissa ( Santa Cecília )</li>
                  </ul>
                </li>
              </ul>
            </p>
          </div>
        </div><!-- .entry-content -->
      </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action('newscard_sidebar');
get_footer();
