import './bootstrap';
import '../css/app.css';
import ApexCharts from "apexcharts";

document.addEventListener('DOMContentLoaded', () => {
    const chartEl = document.querySelector("#chart");
    if (!chartEl) return;

    const options = {
        chart: { type: 'line', height: 350 },
        series: [
            { name: 'Likes', data: window.likes || [] },
            { name: 'Comments', data: window.comments || [] },
            { name: 'Shares', data: window.shares || [] },
        ],
        xaxis: { categories: window.dates || [] },
        yaxis: { min: 0 },
        stroke: { curve: 'smooth' },
        title: { text: 'Social Report (7 Days)', align: 'left' }
    };

    const chart = new ApexCharts(chartEl, options);
    chart.render();
});