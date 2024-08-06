<form class="search">
    <div class="search__icon"><x-admin.icons.search></x-admin.icons.search></div>
    <input type="text" class="search__input" placeholder="Поиск">
    <div class="dropdown search__dropdown">
        <div class="dropdown__choice btn" data-dropdown-show data-start-text="По названию">По названию</div>
        <div class="dropdown__container">
            <ul class="dropdown__list">
                <li class="dropdown__item">
                    <div class="checkbox">
                        <input type="checkbox" class="checkbox__input" name="a" value="1"
                            @checked(true)>
                        <label class="checkbox__label">По символьному коду</span></label>
                    </div>
                </li>
                <li class="dropdown__item">
                    <div class="checkbox">
                        <input type="checkbox" class="checkbox__input" name="a" value="2"
                            @checked(false)>
                        <label class="checkbox__label">По категории</span></label>
                    </div>
                </li>
                <li class="dropdown__item">
                    <div class="checkbox">
                        <input type="checkbox" class="checkbox__input" name="a" value="3"
                            @checked(false)>
                        <label class="checkbox__label">По дате создания</span></label>
                    </div>
                </li>
                <li class="dropdown__item">
                    <div class="checkbox">
                        <input type="checkbox" class="checkbox__input" name="a" value="4"
                            @checked(false)>
                        <label class="checkbox__label">По дате обновления</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</form>
