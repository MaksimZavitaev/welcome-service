<template>
    <div>
        <div v-for="(item, key) in inputs" :key="key">
            <div class="input-group input-group-sm">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger" @click="removeInput(key)">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </div>
                <input class="form-control" type="text" :name="`${name}[]`" v-model="inputs[key]" v-focus/>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-success" @click="addInput">
            <i class="fa fa-plus-circle"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            items: {
                type: String,
            },
            name: {
                type: String,
            },
        },
        data() {
            return {
                inputs: JSON.parse(this.items),
            }
        },
        methods: {
            addInput() {
                this.inputs.push('');
            },
            removeInput(index) {
                this.inputs.splice(index, 1);
            },
        },
        watch: {
            inputs: {
                handler(val) {
                    this.$emit('input', val);
                },
                deep: true,
            }
        }
    }
</script>
