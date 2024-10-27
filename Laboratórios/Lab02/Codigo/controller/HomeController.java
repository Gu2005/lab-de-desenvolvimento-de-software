package codigo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;


//As anotações @Controller e @GetMapping precisam de @ para serem reconhecidas.
//verificar se a anotação @RequestMapping é necessária para definir uma rota basa. 
Controller
public class HomeController {
    
    GetMapping("/")
    public String index() {
        return "index"; // Retorna a página principal (index.html)
    }
}
