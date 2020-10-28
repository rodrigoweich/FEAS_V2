function montarLinha(p){
    const checkStatus = query => {
        const stages = {
            0: 'Comercial',
            1: 'Viabilidade',
            2: 'Operacional',
            3: 'Técnico',
            4: 'SAC'
        };
        return stages[query]
        ? `${stages[query]}`
        : `Indefinido`;
    };

    var next_or_previous;
    if (p.next_stage < p.current_stage) {
        next_or_previous = '<i class="fas text-danger fa-arrow-left fa-lg"></i>';
    } else {
        next_or_previous = '<i class="fas text-success fa-arrow-right fa-lg"></i>';
    }
    var linha = "<tr>"+
                    "<td>"+ next_or_previous + "</td>"+
                    "<td>"+ p.description + "</td>"+
                    "<td>"+ checkStatus(p.current_stage) + "</td>"+
                    "<td>"+ checkStatus(p.next_stage) + "</td>"+
                    "<td>"+ p.created_at + "</td>"+
                    "<td>"+ p.name + "</td>"+
                "</tr>";
    return linha;
}