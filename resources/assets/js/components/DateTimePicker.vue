<template>
</template>

<script>
    export default {
        mounted() {
            $('.date-time-picker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            $('.date-picker').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('.time-picker').datetimepicker({
                format: 'HH:mm'
            });
        }
    }
</script>
