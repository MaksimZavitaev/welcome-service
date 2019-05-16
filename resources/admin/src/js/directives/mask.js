import 'inputmask/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js';
import Inputmask from 'inputmask';
import 'inputmask/dist/inputmask/inputmask.extensions.js';
import 'inputmask/dist/inputmask/inputmask.numeric.extensions.js';
import 'inputmask/dist/inputmask/inputmask.date.extensions.js';

// import log from '_utils/log';


const Mask = {
    bind: (el, { value }) => {
        switch (value) {
            case 'date':
                Inputmask("dd.mm.yyyy", {
                    showMaskOnHover: false,
                    alias: "dd.mm.yyyy",
                    placeholder: "__.__.____"
                }).mask(el);
                break;

            case 'datetime':
                Inputmask("datetime", {
                    showMaskOnHover: false,
                    alias: "datetime",
                    inputFormat: "dd.mm.yyyy HH:MM"
                }).mask(el);
                break;

            case 'age':
                Inputmask("Regex", {
                    showMaskOnHover: false,
                    regex: "^[0-9]{1,2}$"
                }).mask(el);
                break;

            case 'phone':
                Inputmask("+7 (099) 999-99-99", {
                    clearMaskOnLostFocus: true,
                    placeholder: "+7 (XXX) XXX-XX-XX",
                    definitions: {
                        0: {
                            validator: "1|2|3|4|5|6|9|0",
                            cardinality: 1
                        },
                        M: {  //masksymbol
                            "validator": "[\+|(0-9)]"
                        },
                    },
                    onBeforeWrite: function (event, buffer, caretPos, opts) {
                        // log('Phone buffer', buffer);
                        // log('Phone caretPos', caretPos);
                        // log('Phone', opts);
                        // log('Phone event', event);

                        // let obj = {
                        //     pos: 4,
                        //     C: '2',
                        //     caret: 15,
                        // }


                        // if ((event.key == '+' || event.key == '7' || event.key == '8') && caretPos == 1) {
                        //     log('Key', event.key);
                        //     // obj.insert.push({
                        //     //     pos: 1,
                        //     //     c: '+'
                        //     // });
                        //     // obj.insert.push({
                        //     //     pos: 2,
                        //     //     c: event.key
                        //     // });
                        //     obj.pos = 1;
                        //     // obj.c = event.key != '+' ? '+' + event.key : '+7';
                        //     obj.c = 1;
                        //     obj.caret = 4;
                        // } else if (caretPos == 4) {
                        //     obj.c = event.key;
                        //     obj.pos = obj.caret;
                        //     obj.caret = ++obj.caret
                        // }

                        // log('Obj', obj);

                        // return obj;
                    },
                    onincomplete: function () {
                        el.value = '';
                    }
                }).mask(el);
                break;

            case 'loginAlfaclick':
                Inputmask("Regex", {
                    showMaskOnHover: false,
                    regex: "[0-9a-zA-z_@-]{1,10}$",
                    onKeyValidation: function (key, result) {
                        // if (!result) {
                        //     $(this)
                        //         .closest(".u-mask-field")
                        //         .addClass("_error-keyboard");
                        // } else {
                        //     $(this)
                        //         .closest(".u-mask-field")
                        //         .removeClass("_error-keyboard");
                        // }
                    }
                }).mask(el);
                break;

            case 'numberSeparate':
                Inputmask("numeric", {
                    showMaskOnHover: false,
                    autoGroup: true,
                    groupSeparator: ' ',
                    rightAlign: 0,
                    autoUnmask: true,
                }).mask(el)
                break;

            case 'year':
                Inputmask("9999", {
                    clearMaskOnLostFocus: true,
                    placeholder: '____'
                }).mask(el);
                break;

            case 'inn':
                Inputmask("999999999999", {
                    clearMaskOnLostFocus: true,
                    placeholder: '____________'
                }).mask(el);
                break;

            case 'count':
                Inputmask("999", {
                    clearMaskOnLostFocus: true,
                    placeholder: ''
                }).mask(el);
                break;

            case 'passportSeria':
                Inputmask("9999", {
                    clearMaskOnLostFocus: true,
                    placeholder: ''
                }).mask(el);
                break;

            case 'passportNumber':
                Inputmask("999999", {
                    clearMaskOnLostFocus: true,
                    placeholder: ''
                }).mask(el);
                break;

            case 'passportExit':
                Inputmask("Regex", {
                    showMaskOnHover: false,
                    regex: "^[№:;\",.()а-яА-ЯёЁ0-9\\-\\s]*$"
                }).mask(el);
                break;

            case 'russianLetters': // максимум 3 слова
                Inputmask("Regex", {
                    showMaskOnHover: false,
                    regex: "^[а-яА-ЯёЁ\\^s]+[\\-\\s]+[а-яА-ЯёЁ\\^s]+[\\-\\s]+[а-яА-ЯёЁ\\^s]+$"
                }).mask(el);
                break;

            case 'priceSixNumbers':
                Inputmask("999999", {
                    clearMaskOnLostFocus: true,
                    placeholder: ''
                }).mask(el);
                break;

            case 'numberSeparate':
                Inputmask("numeric", {
                    showMaskOnHover: false,
                    autoGroup: true,
                    groupSeparator: ' ',
                    rightAlign: 0,
                    autoUnmask: true,
                }).mask(el)
                break;


            default:
                break;
        }
    }
}

export default Mask;