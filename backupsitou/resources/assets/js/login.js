const login = new Vue({
    delimiters: ['${', '}'],

    el: "#app",
    data: {
        username: '',
        password: '',
        notLogin: true,
        isLogin: false,
        loginFailed: false,
        config: {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Content-Type': 'application/json'
            }
        },
    },
    methods: {
        onLogin() {
            this.isLogin = true
            this.loginFailed = false
            setTimeout(() => {
                axios.post('/front/login', {
                    username: this.username,
                    password: this.password
                }).then(res => {
                    this.notLogin = true
                    window.location = "/front/sitou-app"
                    console.log(res)
                }).catch(error => {
                    console.log(error)
                    this.isLogin = false
                    this.notLogin = false
                    this.loginFailed = true
                    console.log(error)
                }, this.config)

            },500)
        }
    },
    watch: {
        username() {
            this.notLogin = true
            this.loginFailed = false
        },
        password() {
            this.notLogin = true
            this.loginFailed = false
        }
    },
    mounted () {
        new WOW().init();

        setTimeout(() => {

            const text =  baffle(".data");
            text.set({
            characters: '░▒░ ░██░> ████▓ >█> ░/█>█ ██░░ █<▒ ▓██░ ░/░▒',
                    speed: 120
            });

            text.start();
            text.reveal(4000);
            
        }, 3000);

    }
})