$( document ).ready(function() {

    /**
     * disable all disabled links
     */
    (function (){
        $('body').on('click', '.disabled-link', (e)=>{
            e.preventDefault();
        })
    })();

    /**
     * bootstrap selectpicker plugin
     */
    (function (){
        let selects = $('.selectpicker');
        if( ! selects.length ){ return }
        selects.selectpicker();
    })();

    /**
     * bootstrap modal,
     * toggle modal image
     */
    (function (){
        const cardImageModal = $('#card-image-modal');
        if( !cardImageModal.length){ return }

        cardImageModal.on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            const imageSrc = $(button).closest('.g-card-product-basket-image-box').find('.g-card-product-basket-image').attr('src');
            $(this).find('.modal-image').attr('src', imageSrc);
        });

        cardImageModal.on('hidden.bs.modal', function () {
            $(this).find('.modal-image').attr('src', '');
        })
    })();

    animateNumbersChange();

    function animateNumbersChange() {
        const numsBox = $('.g-scroll-nums-box');
        if( !numsBox.length){ return }

        $(window).scroll(function() {
            _isScrolledIntoView(numsBox) ? _counterAnimate($('.g-scroll-num')) : null;
        });

        _isScrolledIntoView(numsBox) ? _counterAnimate($('.g-scroll-num')) : null;

        function _isScrolledIntoView(numBox){
            let docViewTop = $(window).scrollTop();
            let docViewBottom = docViewTop + $(window).height();
            let elemTop = $(numBox).offset().top;
            let elemBottom = elemTop + $(numBox).height();
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        function _counterAnimate(numElem){
            numElem.each(function() {
                let $this = $(this);

                $({ countNum: $this.text()}).animate({
                        countNum: $this.attr('data-num'),
                    },
                    {
                        duration: 5000,
                        easing:'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
            });
        }
    }

    /**
     * bootstrap form validation
     */
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            let validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    /**
     * bootstrap sub dropdown
     */
    $('.g-navbar .dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        let $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.g-navbar .dropdown-submenu .show').removeClass('show');
        });
        return false;
    });

    /**
     * rating stars plugin
     */
    (function(){
        const starContainer = $('.star-container');
        if( ! starContainer.length ){ return }

        starContainer.rating(function(vote, event){
            $(event.target).closest('.rating-box').find('.rating-value').val(vote);
        });
    })();

    /**
     * owl carousel plugin
     */
    (function () {
        const owlCarouselBox = $('.owl-carousel-box');
        if(! owlCarouselBox.length){return }

        owlCarouselBox.owlCarousel({
            loop: true,
            center: true,
            margin: 0,
            responsiveClass: true,
            autoplay: true,
            autoplayHoverPause:true,
            autoplayTimeout:3000,
            smartSpeed: 700,
            nav: true,
            dots: true,
            navigation: true,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 5,
                }
            },
        });

        let owlItemCenter = $('.owl-item.center');
        owlItemCenter.prev().prev().addClass('owl-item-third');
        owlItemCenter.next().next().addClass('owl-item-third');

        owlCarouselBox.on('changed.owl.carousel', function(event) {
            $(this).find('.owl-item').removeClass('owl-item-third');

            setTimeout(function(){
                let owlItemCenterAfterSliding = $('.owl-item.center');
                owlItemCenterAfterSliding.prev().prev().addClass('owl-item-third');
                owlItemCenterAfterSliding.next().next().addClass('owl-item-third');
            }, 0);

        });


    })();

    /**
     * togle translation languages select in event form
     */
    (function(){
        const languagesToggleCheck = $('.languages-toggle-check');
        if( ! languagesToggleCheck.length ){ return }

        languagesToggleCheck.on('change', ()=>{
            $('.languages-toggle-col').toggle('blind');
        })
    })();

    /**
     * edit personal data card-form
     */
    (function(){
        const personalDataEdit = $('.personal-data-edit');
        if( ! personalDataEdit.length ){ return }

        const personalDataBar = personalDataEdit.closest('.personal-data-bar');
        const personalImageDel = personalDataBar.find('.personal-image-del');

        personalDataEdit.on('click', function (){
            personalDataEdit.css('visibility', 'hidden');
            elementsToggler();

            const imageSrc = $(this).closest('.personal-data-bar').find('.personal-image').attr('src');
            if( imageSrc.includes('default-profile-image') ){
                personalImageDel.hide('blind');
            } else {
                personalImageDel.show('blind');
            }
        });

        $('.personal-data-cancel').on('click', function () {
            personalDataEdit.css('visibility', 'visible');
            elementsToggler();
            personalImageDel.hide('blind');
        });

        const elementsToggler = ()=>{
            personalDataBar.find('.personal-data-toggler').toggle();
            personalDataBar.find('.personal-data-btn-col').toggle('blind');
            personalDataBar.find('.personal-image-label').toggle('blind');
            personalDataBar.closest('.personal-data-form').toggleClass('personal-data-form-editing');
        }
    })();

    /**
     * delete personal data user image
     */
    // (function (){
    //     $('.personal-image-del').click(function (){
    //         $(this).hide('blind');
    //         const image = $(this).closest('.personal-image-box').find('.personal-image');
    //         let imageSrc = image.attr('src');
    //
    //         imageSrc = imageSrc.split('/');
    //         imageSrc.pop();
    //         imageSrc.push('default-profile-image.png');
    //         imageSrc = imageSrc.join('/');
    //         image.attr('src', imageSrc);
    //
    //     });
    // })();

    /**
     * add duration form day
     */
     (function(){
        const durationFormAdd = $('.duration-form-add');
        if( ! durationFormAdd.length ){ return }

        let durationFormDayCount = 2;
        durationFormAdd.click(function () {
            const appendingSelect = $(`
                <select class="form-control g-form-control g-form-control-sm selectpicker" id="duration-${durationFormDayCount}-select" aria-describedby="fieldInterpretationHelp">
                    <option value="full day">Full day</option>
                    <option value="half day">Half day</option>
                    <option value="hour">Hour</option>
                </select>
            `);

            const durationFormRowsList = $(this).closest('.duration-form-box').find('.duration-form-rows-list');
            const clonedDurationRow = durationFormRowsList.find('.duration-form-row').first().clone(true, true);
            clonedDurationRow.append('<button class="duration-form-row-del form-hidden-elem g-btn light-color p-0" type="button"><i class="fas fa-times"></i></button>');
            clonedDurationRow.find('.duration-form-day-count').text(durationFormDayCount);
            clonedDurationRow.find('label').attr('for',`duration-${durationFormDayCount}-input`);
            clonedDurationRow.find('input[type="date"]').attr('id',`duration-${durationFormDayCount}-input`);
            clonedDurationRow.find('.bootstrap-select').remove();
            clonedDurationRow.find('.duration-responsive-col').html(appendingSelect);
            durationFormRowsList.append(clonedDurationRow);
            durationFormDayCount ++;

            clonedDurationRow.find('.selectpicker').selectpicker();
        });
    })();

    /**
     * delete duration form day
     */
    (function (){
        $('.duration-form-rows-list').on('click', '.duration-form-row-del', function (){
           $(this).closest('.duration-form-row').hide('blind', function (){
               $(this).remove()
           });
        });
    })();



    /**
     * toggle job form place buttons and inputs
     */
    (function(){
        const jobPlaceBtn = $('.job-place-btn');
        if( ! jobPlaceBtn.length ){ return }

        jobPlaceBtn.on('click', function (){
            const $this = $(this);
            $this.closest('.job-place-box').find('[type="radio"]').attr('checked', false);
            $this.closest('.job-place-item').find('[type="radio"]').attr('checked', 'checked');
            $this.closest('.job-place-box').find('.job-place-input').attr('disabled', true);
            $this.closest('.job-place-item').find('.job-place-input').removeAttr('disabled');
            $this.closest('.job-place-box').find('.job-place-btn').removeClass('g-btn-green').addClass('g-btn-green-ol');
            $this.removeClass('g-btn-green-ol').addClass('g-btn-green');
        });
    })();

    /**
     * wish card checking
     */
    (function (){
        const wishCardCheckboxes = $('.wish-card-check');
        if( ! wishCardCheckboxes.length){return }

        const allCheckedCheckboxes = $('.wish-card-check:checked');

        if(allCheckedCheckboxes.length > 1){
            allCheckedCheckboxes.closest('.wish-list-box').find('.wish-cards-list-send').removeClass('disabled-link g-btn-grey-ol').addClass('g-btn-grey');
        } else {
            $.each(wishCardCheckboxes, (k, v)=>{
                $(v).prop('checked') ? $(v).closest('.g-card-wish').find('.wish-card-send').removeClass('disabled-link g-btn-grey-ol').addClass('g-btn-grey') : null;
            });
        }

        $('#wish-cards-list').on('change', '.wish-card-check', function (){
            const wishCardSend = $(this).closest('.g-card-wish').find('.wish-card-send');
            const wishCardsListSend = $(this).closest('.wish-list-box').find('.wish-cards-list-send');
            const checkedCheckboxes = $(this).closest('#wish-cards-list').find('.wish-card-check:checked');
            const checkedWishCardSend = checkedCheckboxes.closest('.g-card-wish').find('.wish-card-send');

            $(this).prop('checked') ? wishCardSend.removeClass('disabled-link g-btn-grey-ol').addClass('g-btn-grey') : wishCardSend.addClass('disabled-link g-btn-grey-ol').removeClass('g-btn-grey');

            if(checkedCheckboxes.length > 1){
                checkedWishCardSend.addClass('disabled-link g-btn-grey-ol').removeClass('g-btn-grey');
                wishCardsListSend.removeClass('disabled-link g-btn-grey-ol').addClass('g-btn-grey');
            } else {
                checkedWishCardSend.removeClass('disabled-link g-btn-grey-ol').addClass('g-btn-grey');
                wishCardsListSend.addClass('disabled-link g-btn-grey-ol').removeClass('g-btn-grey');
            }

        });
    })();

    /**
     * card counter buttons toggle
     */
    (function (){
        $('body').on('click', '.g-card-toggle-btn', function (){
           const togglePoint = $(this).closest('.g-card-toggle-buttons').find('.g-card-toggle-point');
           let pointText = parseInt( togglePoint.text().trim() );

            switch ( $(this).data('role') ) {
                case 'plus':
                    pointText ++;
                    togglePoint.text(pointText);
                    break;
                case 'minus':
                    pointText --;
                    pointText >= 1 ? togglePoint.text(pointText) : null;
                    break;
            }
        });
    })();

    /**
     * toggle services cards active menu
     */
    (function (){
        $('.menu-cards-btn').click(function (){
            const btnTarget = $(this).data('target');
            const menuCardsBox = $(this).closest('.menu-cards');
            menuCardsBox.find('.menu-cards-btn').removeClass('menu-cards-btn-active');
            $(this).addClass('menu-cards-btn-active');
            menuCardsBox.find('.g-card-simple-2').removeClass('g-card-simple-2-active');
            menuCardsBox.find(`.g-card-simple-2[data-role=${btnTarget}]`).addClass('g-card-simple-2-active');
        });
    })();

    /**
     * equipment card wishing
     */
    // (function (){
    //     $('#equipment-cards-list').on('click', '.equipment-wish-btn', function (){
    //         $(this).find('i').toggleClass('far fas');
    //         console.log(this);
    //     });
    // })();

    /**
     * downloads history document download
     */
    (function (){
        $('#downloads-cards-list').on('click', '.download-history-link', function (){
            console.log(this);
        });
    })();

    /**
     * document templates document download
     */
    (function (){
        $('body').on('click', '.document-template-link', function (){
            console.log(this);
        });
    })();

    /**
     * document shop document download
     */
    (function (){
        $('#document-shop-cards-list').on('click', '.document-shop-link', function (){
            console.log(this);
        });
    })();

    /**
     * basket document download
     */
    (function (){
        $('#basket-cards-list').on('click', '.basket-link', function (){
            console.log(this);
        });
    })();

    /**
     * delete online shop card
     */
    (function (){
        $('body').on('click', '.del-online-shop-btn', function (){
            console.log(this);
        });
    })();

    /**
     * delete wish card
     */
    (function (){
        $('#wish-cards-list').on('click', '.del-wish-card-btn', function (){
            console.log(this);
        });
    })();

    /**
     * delete rent equipment card
     */
    (function (){
        $('#rent-equipment-cards-list').on('click', '.del-rent-equipment-btn', function (){
            console.log(this);
        });
    })();

    /**
     * delete basket card
     */
    (function (){
        $('#basket-cards-list').on('click', '.del-basket-card-btn', function (){
            console.log(this);
        });
    })();

    /**
     * clear basket cards
     */
    (function (){
        $('.clear-basket-cards-btn').click(function (){
            console.log(this);
        });
    })();

});


