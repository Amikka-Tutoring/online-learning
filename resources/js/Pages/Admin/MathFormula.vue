<template>
    <admin-layout>
        <div class="container admin-dashboard">
            <h1 class="blue-text">Dashboard</h1>
            <div class="dashboard-content">
                <math-field id="formula" virtual-keyboard-mode=manual
                            style="font-size: 32px;margin: 3em;padding: 8px;border-radius: 8px;">
                    x=\frac{-b\pm \sqrt{b^2-4ac}}{2a}
                </math-field>
                <textarea id="latex"></textarea>
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
    mounted() {
        const mf = document.querySelector('#formula');
        const latexField = document.querySelector('#latex');
        latexField.addEventListener('input', () =>
            mf.setValue(latexField.value)
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
