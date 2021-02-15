// import { Options, Vue } from "vue-class-component";
import { Vue, mixins, Options, prop } from 'vue-class-component';
// import { Watch } from "vue-property-decorator";
import $ from "jquery";
import 'select2'


class Select2Props {
    // selected = prop({
    //     type: Number,
    // })
    options = prop({
        type: Object,
    })
}

@Options({
    name: 'Select2',
    emits: ["select2Changed"]
})


export default class BaseSelect2 extends Vue.with(Select2Props) {
    public defaultOptions!: {}
    created() {

        this.defaultOptions = {
            // width: '100%',
            placeholder: '-- Please select --',
            allowClear: true
        }
        // console.log(this.defaultOptions)
    }
    mounted() {
        var vue = this;
        if (this.options) this.defaultOptions = this.options
        $(this.$el).select2(this.defaultOptions)
        .on("change", function () {
            vue.$emit("select2Changed", this.value);
        });
    }
    destroyed() {
        $(this.$el).off().select2("destroy");
    }
}

// const app = Vue.createApp({
//     template: "#demo-template",
//     data: function () {
//         return {
//             selected: 2,
//             options: [
//                 { id: 1, text: "Hello" },
//                 { id: 2, text: "World" }
//             ]
//         }
//     }
// });

// app.component("select2", {
//     props: ["options", "modelValue"],
//     template: "#select2-template",
//     mounted: function () {
//         var vm = this;
//         $(this.$el)
//             // init select2
//             .select2({ data: this.options })
//             .val(this.value)
//             .trigger("change")
//             // emit event on change.
//             .on("change", function () {
//                 vm.$emit("update:modelValue", this.value);
//             });
//     },
//     watch: {
//         modelValue: function (value) {
//             // update value
//             $(this.$el)
//                 .val(value)
//                 .trigger("change");
//         },
//         options: function (options) {
//             // update options
//             $(this.$el)
//                 .empty()
//                 .select2({ data: options });
//         }
//     },
//     destroyed: function () {
//         $(this.$el)
//             .off()
//             .select2("destroy");
//     }
// });

// app.mount('#el');
