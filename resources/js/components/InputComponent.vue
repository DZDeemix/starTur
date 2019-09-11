<template>
    <div class="col-md-4 mb-3">
        <label :for="label">{{title}}</label>
        <input type="text" v-bind="$attrs"
               v-bind:value="value"
               v-on:input="$emit('input', $event.target.value)"
               :class="{'is-invalid': is_validated && is_validated_form,
                       'is-valid': is_validated && is_validated_form}"
               class="form-control" :id="label" />
        <div v-if="is_validated_form" v-for="error in error_data"
             :class="{
                        'invalid-feedback': is_validated && is_validated_form,
                        'valid-feedback': is_validated && is_validated_form
                        }">
            {{error}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "InputComponent",
        inheritAttrs: false,
        props: {
            is_validated: {
                type: Boolean,
                default: false,
            },
            error_data: {
                type: Array,
                default: [],
            },
            is_validated_form: {
                type: Boolean,
                default: false,
            },
            value: {
                type: String
            },
            label: {
                type: String
            },
            title: {
                type: String
            }
        },
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>
