(function ($) {
  "use strict";



  if ($(".range-slider-month").length) {

  }

  if ($(".range-slider-count").length) {

  }

    // Smooth scroll for the navigation menu and links with .scrollto classes
    $(document).on('click', '.main-menu a, .mobile-nav a, .scrollto', function(e) {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        e.preventDefault();
        var target = $(this.hash);
        if (target.length) {
  
          var scrollto = target.offset().top;
          var scrolled = 20;
  
          if ($('#header').length) {
            scrollto -= $('#header').outerHeight()
  
            if (!$('#header').hasClass('header-scrolled')) {
              scrollto += scrolled;
            }
          }
  
          if ($(this).attr("href") == '#header') {
            scrollto = 0;
          }
  
          $('html, body').animate({
            scrollTop: scrollto
          }, 1500, 'easeInOutExpo');
  
          if ($(this).parents('.main-menu, .mobile-nav').length) {
            $('.main-menu .active, .mobile-nav .active').removeClass('active');
            $(this).closest('li').addClass('active');
          }
  
          if ($('body').hasClass('mobile-nav-active')) {
            $('body').removeClass('mobile-nav-active');
            $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
            $('.mobile-nav-overly').fadeOut();
          }
          return false;
        }
      }
    });
    
  if ($("#loan-calculator").length) {

    var monthRange = document.getElementById("range-slider-month");
    var countRange = document.getElementById("range-slider-count");
    var interest_period = document.getElementById("interest_period");
    var interest_method = document.getElementById("interest_method");
    var repayment_cycle = document.getElementById("repayment_cycle");
    var minprin = document.getElementById("minimum_principal");
    var maxprin = document.getElementById("maximum_principal");

    var principal = 0;
    var intRate = 0;
    var due = 0;
    var loanper = 0;
    var loaninterest = 0;


    var limitFieldMinMonth = document.getElementById("min-value-rangeslider-month");
    var limitFieldMaxMonth = document.getElementById("max-value-rangeslider-month");

    var limitFieldMinCount = document.getElementById("min-value-rangeslider-count");
    var limitFieldMaxCount = document.getElementById("max-value-rangeslider-count");
    var interestRate = $("#loan-calculator").data("interest-rate");


    noUiSlider.create(monthRange, {
      start: 3,
      behaviour: "snap",
      step: 1,
      tooltips: [wNumb({ decimals: 0 })],
      connect: [true, false],
      range: {
        min: 1,
        max: 12
      }
    });

    var minA = parseInt(minprin.value);
    var maxA = parseInt(maxprin.value);

   
    noUiSlider.create(countRange, {
      start: minA,
      step: 1000,
      tooltips: [wNumb({ decimals: 0, prefix: "N" })],
      behaviour: "snap",
      connect: [true, false],
      range: {
        min: minA,
        max: maxA
      }
    });


    monthRange.noUiSlider.on("update", function (values, handle) {
      (handle ? $(limitFieldMaxMonth) : $(limitFieldMinMonth)).attr(
        "value",
        values[handle]
      );
      let loanMoney = limitFieldMinCount.value;
     
    let loanMonth = parseInt(values[handle], 10);
    intRate = determine_interest_rate(repayment_cycle.value, interest_period.value, interestRate);
    loanper = loan_period(repayment_cycle.value,interest_period.value,loanMonth);
    
    if (interest_method.value == 'flat_rate') {
       principal = loanMoney / loanper;
       loaninterest = (intRate * loanMoney);
       due = principal + loaninterest;
    }


      $("#loan-month").html(parseInt(loanper, 10));
      $("#loan-monthly-pay").html(parseInt(due, 10));
      $("#loan-total").html(parseInt(due*loanper, 10));
    });


    countRange.noUiSlider.on("update", function (values, handle) {
      (handle ? $(limitFieldMaxCount) : $(limitFieldMinCount)).attr(
        "value",
        values[handle]
      );

      let loanMonth = limitFieldMinMonth.value;
      let loanMoney = parseInt(values[handle],10);

      intRate = determine_interest_rate(repayment_cycle.value, interest_period.value, interestRate);
      loanper = loan_period(repayment_cycle.value,interest_period.value,loanMonth);
      
      if (interest_method.value == 'flat_rate') {
         principal = loanMoney / loanper;
         loaninterest = (intRate * loanMoney);
         due = principal + loaninterest;
      }
  
  
        $("#loan-month").html(parseInt(loanper, 10));
        $("#loan-monthly-pay").html(parseInt(due, 10));
        $("#loan-total").html(parseInt(due*loanper, 10));
    });

    let loanMoney = limitFieldMinCount.value;
    let loanMonth = limitFieldMinMonth.value;
        
    intRate = determine_interest_rate(repayment_cycle.value, interest_period.value, interestRate);
    loanper = loan_period(repayment_cycle.value,interest_period.value,loanMonth);
    
    if (interest_method.value == 'flat_rate') {
       principal = loanMoney / loanper;
       loaninterest = (intRate * loanMoney);
       due = principal + loaninterest;
    }
     

    $("#loan-month").html(parseInt(loanper, 10));
    $("#loan-monthly-pay").html(parseInt(due, 10));
    $("#loan-total").html(parseInt(due*loanper, 10));

  }

  if ($(".scroll-to-target").length) {
    $(".scroll-to-target").on("click", function () {
      var target = $(this).attr("data-target");
      // animate
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top
        },
        1000
      );

      return false;
    });
  }

  if ($(".contact-form-validated").length) {
    $(".contact-form-validated").validate({
      // initialize the plugin
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        message: {
          required: true
        },
        subject: {
          required: true
        }
      },
      submitHandler: function (form) {
        // sending value with ajax request
        $.post($(form).attr("action"), $(form).serialize(), function (
          response
        ) {
          $(form).parent().find(".result").append(response);
          $(form).find('input[type="text"]').val("");
          $(form).find('input[type="email"]').val("");
          $(form).find("textarea").val("");
        });
        return false;
      }
    });
  }

  // mailchimp form
  if ($(".mc-form").length) {
    $(".mc-form").each(function () {
      var Self = $(this);
      var mcURL = Self.data("url");
      var mcResp = Self.parent().find(".mc-form__response");

      Self.ajaxChimp({
        url: mcURL,
        callback: function (resp) {
          // appending response
          mcResp.append(function () {
            return '<p class="mc-message">' + resp.msg + "</p>";
          });
          // making things based on response
          if (resp.result === "success") {
            // Do stuff
            Self.removeClass("errored").addClass("successed");
            mcResp.removeClass("errored").addClass("successed");
            Self.find("input").val("");

            mcResp.find("p").fadeOut(10000);
          }
          if (resp.result === "error") {
            Self.removeClass("successed").addClass("errored");
            mcResp.removeClass("successed").addClass("errored");
            Self.find("input").val("");

            mcResp.find("p").fadeOut(10000);
          }
        }
      });
    });
  }

  if ($(".video-popup").length) {
    $(".video-popup").magnificPopup({
      disableOn: 700,
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: true,

      fixedContentPos: false
    });
  }

  if ($(".img-popup").length) {
    var groups = {};
    $(".img-popup").each(function () {
      var id = parseInt($(this).attr("data-group"), 10);

      if (!groups[id]) {
        groups[id] = [];
      }

      groups[id].push(this);
    });

    $.each(groups, function () {
      $(this).magnificPopup({
        type: "image",
        closeOnContentClick: true,
        closeBtnInside: false,
        gallery: {
          enabled: true
        }
      });
    });
  }

  function determine_interest_rate(repayment_cycle, interest_period, interest_rate)
  {
     var interest = '';
    if (repayment_cycle == 'annually') {
      //return the interest per year
      if (interest_period == 'year') {
           interest = interest_rate;
      }
      if (interest_period == 'month') {
         interest = interest_rate * 12;
      }
      if (interest_period == 'week') {
          interest = interest_rate * 52;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 365;
      }
  }
  if (repayment_cycle == 'semi_annually') {
      //return the interest per semi annually
      if (interest_period == 'year') {
          interest = interest_rate / 2;
      }
      if (interest_period == 'month') {
          interest = interest_rate * 6;
      }
      if (interest_period == 'week') {
          interest = interest_rate * 26;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 182.5;
      }
  }
  if (repayment_cycle == 'quarterly') {
      //return the interest per quaterly

      if (interest_period == 'year') {
          interest = interest_rate / 4;
      }
      if (interest_period == 'month') {
          interest = interest_rate * 3;
      }
      if (interest_period == 'week') {
          interest = interest_rate * 13;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 91.25;
      }
  }
  if (repayment_cycle == 'bi_monthly') {
      //return the interest per bi-monthly
      if (interest_period == 'year') {
          interest = interest_rate / 6;
      }
      if (interest_period == 'month') {
          interest = interest_rate * 2;
      }
      if (interest_period == 'week') {
          interest = interest_rate * 8.67;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 58.67;
      }

  }

  if (repayment_cycle == 'monthly') {
      //return the interest per monthly

      if (interest_period == 'year') {
          interest = interest_rate / 12;
      }
      if (interest_period == 'month') {
          interest = interest_rate * 1;
      }
      if (interest_period == 'week') {
          interest = interest_rate * 4.33;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 30.4;
      }
  }
  if (repayment_cycle == 'weekly') {
      //return the interest per weekly

      if (interest_period == 'year') {
          interest = interest_rate / 52;
      }
      if (interest_period == 'month') {
          interest = interest_rate / 4;
      }
      if (interest_period == 'week') {
          interest = interest_rate;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 7;
      }
  }
  if (repayment_cycle == 'daily') {
      //return the interest per day

      if (interest_period == 'year') {
          interest = interest_rate / 365;
      }
      if (interest_period == 'month') {
          interest = interest_rate / 30.4;
      }
      if (interest_period == 'week') {
          interest = interest_rate / 7.02;
      }
      if (interest_period == 'day') {
          interest = interest_rate * 1;
      }
    }
    return interest / 100;
  }




    function loan_period(repayment_cycle,loan_duration_type,loan_duration)
    {
        var period = 0;

        if (repayment_cycle == 'annually') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration * 12);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 52);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 365);
            }
        }
        if (repayment_cycle == 'semi_annually') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration * 2);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration * 6);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 26);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 182.5);
            }
        }
        if (repayment_cycle == 'quarterly') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration * 12);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 52);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 365);
            }
        }
        if (repayment_cycle == 'bi_monthly') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration * 6);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration / 2);

            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 8);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 60);
            }
        }

        if (repayment_cycle == 'monthly') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration * 12);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 4.3);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 30.4);
            }
        }
        if (repayment_cycle == 'weekly') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration * 52);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration * 4);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 1);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration * 7);
            }
        }
        if (repayment_cycle == 'daily') {
            if (loan_duration_type == 'year') {
                period = Math.ceil(loan_duration * 365);
            }
            if (loan_duration_type == 'month') {
                period = Math.ceil(loan_duration * 30.42);
            }
            if (loan_duration_type == 'week') {
                period = Math.ceil(loan_duration * 7.02);
            }
            if (loan_duration_type == 'day') {
                period = Math.ceil(loan_duration);
            }
        }
        return period;
    }


  function dynamicCurrentMenuClass(selector) {
    let FileName = window.location.href.split("/").reverse()[0];

    selector.find("li").each(function () {
      let anchor = $(this).find("a");
      if ($(anchor).attr("href") == FileName) {
        $(this).addClass("current");
      }
    });
    // if any li has .current elmnt add class
    selector.children("li").each(function () {
      if ($(this).find(".current").length) {
        $(this).addClass("current");
      }
    });
    // if no file name return
    if ("" == FileName) {
      selector.find("li").eq(0).addClass("current");
    }
  }
  if ($(".main-menu__list").length) {
    // dynamic current class
    let mainNavUL = $(".main-menu__list");
    dynamicCurrentMenuClass(mainNavUL);
  }

  if ($(".mobile-nav__container").length) {
    let navContent = document.querySelector(".main-menu").innerHTML;
    let mobileNavContainer = document.querySelector(".mobile-nav__container");
    mobileNavContainer.innerHTML = navContent;
  }
  if ($(".sticky-header__content").length) {
    let navContent = document.querySelector(".main-menu").innerHTML;
    let mobileNavContainer = document.querySelector(".sticky-header__content");
    mobileNavContainer.innerHTML = navContent;
  }

  if ($(".mobile-nav__container .main-menu__list").length) {
    let dropdownAnchor = $(
      ".mobile-nav__container .main-menu__list .dropdown > a"
    );
    dropdownAnchor.each(function () {
      let self = $(this);
      let toggleBtn = document.createElement("BUTTON");
      toggleBtn.setAttribute("aria-label", "dropdown toggler");
      toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
      self.append(function () {
        return toggleBtn;
      });
      self.find("button").on("click", function (e) {
        e.preventDefault();
        let self = $(this);
        self.toggleClass("expanded");
        self.parent().toggleClass("expanded");
        self.parent().parent().children("ul").slideToggle();
      });
    });
  }

  if ($(".mobile-nav__toggler").length) {
    $(".mobile-nav__toggler").on("click", function (e) {
      e.preventDefault();
      $(".mobile-nav__wrapper").toggleClass("expanded");
    });
  }

  if ($(".search-toggler").length) {
    $(".search-toggler").on("click", function (e) {
      e.preventDefault();
      $(".search-popup").toggleClass("active");
    });
  }
  if ($(".odometer").length) {
    $(".odometer").appear(function (e) {
      var odo = $(".odometer");
      odo.each(function () {
        var countNumber = $(this).attr("data-count");
        $(this).html(countNumber);
      });
    });
  }

  if ($(".wow").length) {
    var wow = new WOW({
      boxClass: "wow", // animated element css class (default is wow)
      animateClass: "animated", // animation css class (default is animated)
      mobile: true, // trigger animations on mobile devices (default is true)
      live: true // act on asynchronously loaded content (default is true)
    });
    wow.init();
  }

  if ($("#donate-amount__predefined").length) {
    let donateInput = $("#donate-amount");
    $("#donate-amount__predefined")
      .find("li")
      .on("click", function (e) {
        e.preventDefault();
        let amount = $(this).find("a").text();
        donateInput.val(amount);
        $("#donate-amount__predefined").find("li").removeClass("active");
        $(this).addClass("active");
      });
  }

  $("#accordion .collapse").on("shown.bs.collapse", function () {
    $(this).prev().addClass("active");
    $(this).prev().parent().addClass("active");
  });

  $("#accordion .collapse").on("hidden.bs.collapse", function () {
    $(this).prev().removeClass("active");
    $(this).prev().parent().removeClass("active");
  });

  $("#accordion").on("hide.bs.collapse show.bs.collapse", (e) => {
    $(e.target).prev().find("i:last-child").toggleClass("fa-plus fa-minus");
  });

  // window load event

  $(window).on("load", function () {
    if ($(".preloader").length) {
      $(".preloader").fadeOut();
    }

    // swiper slider
    const swiperElm = document.querySelectorAll(".thm-swiper__slider");
    swiperElm.forEach(function (swiperelm) {
      const swiperOptions = JSON.parse(swiperelm.dataset.swiperOptions);
      let thmSwiperSlider = new Swiper(swiperelm, swiperOptions);
    });
  });

  // window load event

  $(window).on("scroll", function () {
    if ($(".stricked-menu").length) {
      var headerScrollPos = 130;
      var stricky = $(".stricked-menu");
      if ($(window).scrollTop() > headerScrollPos) {
        stricky.addClass("stricky-fixed");
      } else if ($(this).scrollTop() <= headerScrollPos) {
        stricky.removeClass("stricky-fixed");
      }
    }
    if ($(".scroll-to-top").length) {
      var strickyScrollPos = 100;
      if ($(window).scrollTop() > strickyScrollPos) {
        $(".scroll-to-top").fadeIn(500);
      } else if ($(this).scrollTop() <= strickyScrollPos) {
        $(".scroll-to-top").fadeOut(500);
      }
    }
  });
})(jQuery);
