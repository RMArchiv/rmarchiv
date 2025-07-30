import {
    ArcElement,
    Chart,
    Colors,
    BarController,
    PieController,
    CategoryScale,
    LinearScale,
    BarElement,
    PointElement,
    LineElement,
    Legend,
    LineController,
    Filler
  } from "chart.js";
  Chart.register(
    ArcElement,
    Colors,
    BarController,
    PieController,
    BarElement,
    CategoryScale,
    LinearScale,
    Legend,
    LineElement,
    PointElement,
    LineController,
    Filler
  );
  window["Chart"] = Chart;