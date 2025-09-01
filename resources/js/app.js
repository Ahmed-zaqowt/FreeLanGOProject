import './bootstrap';
// إضافة meta tag في layout الرئيسي
// <meta name="user-id" content="{{ auth()->id() }}">

const app = new Vue({
    el: '#app',

    data: {
        notificationCount: 0,
    },

    mounted() {
        this.listenForNotifications();
        this.updateNotificationsCount();
    },

    methods: {
        listenForNotifications() {
            const userId = document.querySelector("meta[name='user-id']")?.getAttribute('content');

            if (userId) {
                window.Echo.private(`user.${userId}`)
                    .notification((notification) => {
                        console.log('تم استقبال إشعار:', notification);
                        this.showNotification(notification);
                        this.updateNotificationsCount();
                    });
            }
        },

        showNotification(notification) {
            // استخدام Toastify لعرض الإشعار
            if (typeof Toastify !== 'undefined') {
                Toastify({
                    text: notification.message,
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    onClick: () => {
                        if (notification.url) {
                            window.location.href = notification.url;
                        }
                    }
                }).showToast();
            }

            // أو استخدام إشعارات المتصفح
            this.showBrowserNotification(notification);
        },

        showBrowserNotification(notification) {
            if (!('Notification' in window)) {
                return;
            }

            if (Notification.permission === 'default') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        this.createBrowserNotification(notification);
                    }
                });
            } else if (Notification.permission === 'granted') {
                this.createBrowserNotification(notification);
            }
        },

        createBrowserNotification(notification) {
            const browserNotification = new Notification('عرض جديد', {
                body: notification.message,
                icon: '/icon.png'
            });

            browserNotification.onclick = () => {
                if (notification.url) {
                    window.location.href = notification.url;
                }
            };
        },

        updateNotificationsCount() {
            axios.get('/notifications/count')
                .then(response => {
                    this.notificationCount = response.data.count;
                })
                .catch(error => {
                    console.error('خطأ في جلب عدد الإشعارات:', error);
                });
        }
    }
});
