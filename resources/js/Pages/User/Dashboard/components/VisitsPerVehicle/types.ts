interface VisitsPerVehicleProps {
  vehicles: {
    id: number;
    slug: string;
    title: string;
    visits: number;
    type: string;
  }[];
}

interface VisitsPerVehicleChartProps {
  options: ApexCharts.ApexOptions;
  series: ApexAxisChartSeries | ApexNonAxisChartSeries;
}

export type { VisitsPerVehicleChartProps, VisitsPerVehicleProps };
