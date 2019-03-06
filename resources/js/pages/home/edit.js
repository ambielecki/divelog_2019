let app = new Vue({
    el: '#home_edit_app',
    data: {
        count: null,
        current_content: {},
        current_page: {},
        display_hero_path: '',
        images: [],
        image_destination: 'for_carousel',
        images_loading: false,
        limit: 20,
        page: 1,
        pages: null,
        search: null,
        selected_image: {},
    },
    mounted: function () {
        this.current_page = HomeEdit.current_page;
        this.current_content = HomeEdit.current_content;
        if (this.current_content.hasOwnProperty('hero_image')) {
            this.display_hero_path = '/' +this.current_content.hero_image.folder + this.current_content.hero_image.file_name;
        }

        this.getImageList();
    },
    methods: {
        imageThumbClick(clicked_image) {
            this.selected_image = clicked_image;
            console.log('click')
        },

        paginationClick(page) {
            this.page = page;
            this.getImageList();
        },

        getImageList() {
            this.images_loading = true;
            Axios.get('/api/admin/images', {
                params: {
                    page: this.page,
                    limit: this.limit,
                    search: this.search,
                    is_hero: this.image_destination === 'for_hero',
                }
            }).then(function (response) {
                app.images_loading = false;
                app.images = response.data.images;
                app.count = response.data.count;
                app.limit = response.data.limit;
                app.page = response.data.page;
                app.pages = response.data.pages;
                app.selected_image = {};

                app.images.forEach(function (image, index) {
                    Vue.set(app.images[index], 'is_active', false);
                });
            }).catch(function (error) {
                this.images_loading = false;
                console.log(error);
            });
        },

        searchImages: DiveLogRepeat.debounce(function () {
            this.getImageList();
        }, 500),
    },
});
