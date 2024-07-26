<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (is_active_sidebar('shop')) {
	dynamic_sidebar('shop');
}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
?>
<div class="categ-1-categ__filter">
	<h3 class="sd-catalog__filter-heading">
		Фильтр по параметрам
		<button class="categ-1-categ__filteres-close"></button>
	</h3>

	<div class="menu-item details">
		<div class="summary summary-open">Категория</div>
		<a href="catalog.html" class="sub-menu details-open">Все</a>
		<a href="catalog.html" class="sub-menu current details-open">Люстры</a>
		<a href="catalog.html" class="sub-menu details-open">Светильники</a>
		<a href="catalog.html" class="sub-menu details-open">Бра</a>
		<a href="catalog.html" class="sub-menu details-open">Торшеры</a>
		<a href="catalog.html" class="sub-menu details-open">Лампы настольные</a>
	</div>

	<div class="categ-1-categ__filteres">
		<div class="categ-1-categ__price details ">
			<div class="summary summary-open">
				Цена
			</div>

			<div class="categ-1-categ__price-range sub-menu details-open">
				<div id="sliderPrice" class="filter__slider-price" data-min="0" data-max="1000000" data-step="10000"></div>

				<div class="categ-1-categ__price-inputs">
					<label class="filter__label">
						<input type="text" class="filter__input">
					</label>
					<label class="filter__label">
						<input type="text" class="filter__input">
					</label>
				</div>
			</div>
		</div>

		<div class="categ-1-categ__colors details">
			<div class="summary summary-open">Цвет</div>

			<form class="sd-card-page__options sub-menu details-open">
				<label class="sd-card-page__color">
					<input type="checkbox" name="#" value="#">
					<span style="background: #fff;"></span>
				</label>
				<label class="sd-card-page__color card-1-card__color_white-cursor">
					<input type="checkbox" name="#" value="#">
					<span style="background: #000;"></span>
				</label>
				<label class="sd-card-page__color">
					<input type="checkbox" name="#" value="#">
					<span
						style="background: linear-gradient(139.74deg, rgb(202, 136, 56) -2.394%,rgb(248, 218, 137) 100.458%);"></span>
				</label>
				<label class="sd-card-page__color">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(204, 202, 186);"></span>
				</label>
				<label class="sd-card-page__color card-1-card__color_white-cursor">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(194, 141, 43);"></span>
				</label>
				<label class="sd-card-page__color">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(209, 196, 111);"></span>
				</label>
				<label class="sd-card-page__color card-1-card__color_white-cursor">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(242, 222, 106);"></span>
				</label>
				<label class="sd-card-page__color">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(189, 187, 93);"></span>
				</label>
				<label class="sd-card-page__color card-1-card__color_white-cursor">
					<input type="checkbox" name="#" value="#">
					<span style="background: rgb(214, 203, 131);"></span>
				</label>
			</form>
		</div>

		<div class="menu-item details sd-catalog__collection">
			<div class="summary summary-open">Коллекция</div>

			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="" checked>
				<span>Aqua luxury</span>
			</label>
			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="">
				<span>Aqua luxury</span>
			</label>
			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="">
				<span>Aqua luxury</span>
			</label>
			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="">
				<span>Aqua luxury</span>
			</label>
			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="">
				<span>Aqua luxury</span>
			</label>
			<label class="cart-1-cart__checkbox sub-menu details-open">
				<input type="checkbox" value="value-1" class="">
				<span>Название коллекции</span>
			</label>
		</div>

		<div class="categ-1-categ__grid-check details">
			<div class="summary summary-open">Диаметр</div>

			<form class="sd-card-page__options sub-menu">
				<label class="sd-card-page__option">
					<input type="checkbox" name="#" value="#">
					<span>G9</span>
				</label>
				<label class="sd-card-page__option">
					<input type="checkbox" name="#" value="#">
					<span>G10</span>
				</label>
				<label class="sd-card-page__option">
					<input type="checkbox" name="#" value="#">
					<span>G11</span>
				</label>
			</form>
		</div>

		<div class="categ-1-categ__buttons">
			<a class="sd-catalog__cancel">Сбросить</a>
			<a class="sd-catalog__done">Применить</a>
		</div>
	</div>
</div>


