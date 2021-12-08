<template>
    <admin-layout>
        <div class="container admin-dashboard">
            <h1 class="blue-text">Math Formula</h1>
            <div class="dashboard-content">
                <h3>Formula Preview</h3>
                <math-field id="formula" virtual-keyboard-mode=manual
                            style="font-size: 32px;margin: 3em;padding: 8px;border-radius: 8px;">
                    x=\frac{-b\pm \sqrt{b^2-4ac}}{2a}
                </math-field>
                <textarea id="latex"></textarea>
                <h3 class="mb-4">Text</h3>
                <textarea name="" cols="30" rows="10" v-model="this.text"></textarea>
                <h3>Final</h3>
                <textarea>{{spaceText(this.text)}}</textarea>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    name: "MathFormula",
    components: {
        AdminLayout,
    },
    data() {
        return {
            text: ''
        }
    },
    methods: {
        spaceText: function (text) {
            let new_text = text.replace(/\s+/g, '\\:')
            return new_text;
        }
    },
    mounted() {
        const mf = document.querySelector('#formula');
        const latexField = document.querySelector('#latex');
        latexField.addEventListener('input', () => {
                mf.setValue(latexField.value)
            }
        );


        function updateLatex() {
            document.querySelector('#latex').value = mf.value;
        }

        mf.addEventListener('input', updateLatex);
        updateLatex();
    }
}
</script>

<style scoped>

</style>
