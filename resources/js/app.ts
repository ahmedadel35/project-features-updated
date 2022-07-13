import "./bootstrap";

import Alpine from "alpinejs";
// import Echo from "laravel-echo";

// @ts-ignore
window.Alpine = Alpine;


// document.addEventListener("alpine:initialized", () => {
//     alert('asdsad');
    // Alpine.store("toast", {
    //     arr: [],
    //     add(message: string, type: string = "default") {
    //         this.arr.push({ show: true, message, type });
    //         setTimeout((_) => {
    //             this.remove(message);
    //         }, 3000);
    //         // console.log(message, type);
    //     },
    //     info(message: string) {
    //         this.add(message);
    //     },
    //     warn(message: string) {
    //         this.add(message, "warn");
    //     },
    //     error(message: string) {
    //         this.add(message, "danger");
    //     },
    //     success(message: string) {
    //         this.add(message, "success");
    //     },
    //     remove(message: string) {
    //         const inx = this.arr.findIndex((x) => x.message === message);
    //         if (!this.arr[inx]) return;
    //         this.arr[inx].show = false;
    //         this.arr.splice(inx, 1);
    //     },
    // });

    Alpine.store("common", {
        dark:
            JSON.parse(localStorage.getItem("dark-theme") as string) ||
            (!!window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches),
        toggleDark(): void {
            this.dark = !this.dark;
            document.documentElement.classList.toggle('dark');
            localStorage.setItem("dark-theme", this.dark);
        },
        testMail(mail: string) {
            return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                mail
            );
        },
        formatNum: (num: number) => {
            var si = [
                { value: 1, symbol: "" },
                { value: 1e3, symbol: "k" },
                { value: 1e6, symbol: "M" },
                { value: 1e9, symbol: "G" },
                { value: 1e12, symbol: "T" },
                { value: 1e15, symbol: "P" },
                { value: 1e18, symbol: "E" },
            ];
            var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
            var i;
            for (i = si.length - 1; i > 0; i--) {
                if (num >= si[i].value) {
                    break;
                }
            }
            return (
                (num / si[i].value).toFixed(1).replace(rx, "$1") + si[i].symbol
            );
        },
        testUrl: (url: string): boolean =>
            /^(http|https):\/\/[^ "]+$/.test(url),
    });
// });

Alpine.start();