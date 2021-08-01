export default {
    data() {
        return {
            email: '',
            subscribed: false,
            subscribing: false,
            error: '',
        };
    },
    watch: {
        email() {
            this.error = '';
        },
    },
    methods: {
        subscribe() {
            if (! this.email || this.subscribed) {
                return;
            }

            this.subscribing = true;

            $.ajax({
                method: 'POST',
                url: route('subscribers.store'),
                data: { email: this.email },
            }).then(() => {
                this.email = '';
                this.subscribed = true;
            }).catch((response) => {
                if (response.status === 422) {
                    this.error =response.responseJSON.errors.email[0];
                } else {
                    this.error =response.responseJSON.message;
                }
            }).always(() => {
                this.subscribing = false;
            });
        },
    },
};
