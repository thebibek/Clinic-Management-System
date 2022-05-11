<script>
$(function() {
    var a, b, c, d, e, a = [
            [gd(2009,12,1), 6],
            [12649824e5, 3057],
            [12674016e5, 3434],
            [127008e7, 12982],
            [1272672e6, 21602],
            [12753504e5, 27826],
            [12779424e5, 24302],
            [12806208e5, 24237],
            [12832992e5, 21004],
            [12858912e5, 12144],
            [12885696e5, 10577],
            [12911616e5, 7295]
        ],
        b = [
            [gd(2009,12,1), 10000],
            [gd(2010,1,1), 200],
            [gd(2010,2,1), 1605],
            [gd(2010,3,1), 1129],
            [gd(2010,4,1), 11643],
            [gd(2010,5,1), 19055],
            
        ],
        c = [
            [gd(2009,12,1), 5000],
            [gd(2010,1,1), 9010],
            [gd(2010,2,1), 21205],
            [gd(2010,3,1), 31129],
            [gd(2010,4,1), 32643],
            [gd(2010,5,1), 56055],
            
        ];
    d = [ {
        label: "Sales",
        data: b
    }, {
        label: "Expenses",
        data: c
    }], e = {
        xaxis: {
            min: new Date(2009, 12).getTime(),
            max: new Date(2010, 12).getTime(),
            mode: "time",
            tickSize: [1, "month"],
            monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            tickLength: 0
        },
        yaxis: {},
        series: {
            stack: !0,
            lines: {
                show: !0,
                fill: .1,
                lineWidth: 2
            },
            points: {
                show: !0,
                radius: 4,
                fill: !0,
                fillColor: "#FFFFFF",
                lineWidth: 2
            }
        },
        grid: {
            hoverable: !0,
            clickable: !1,
            borderWidth: 1,
            tickColor: "#dfe2f0",
            borderColor: "#dfe2f0"
        },
        legend: {
            show: !0,
            position: "nw"
        },
        shadowSize: 0,
        tooltip: !0,
        tooltipOpts: {
            content: "%s: %y"
        },
        colors: ["#ff7671", "#ffda68", "#3fcbca", "#4bb5ea"]
    };
    var f = $("#stacked-area-chart");
    f.length && $.plot(f, d, e)
});

function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}

</script>