$(".price-slider").asRange({
    range: true,
    limit: false,
    max: 20000,
	min: 10000,
    step: 100,
    tip: {
        active: 'onMove'
    },
    keyboard: true
});
