//
//  Eleve.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Eleve: Codable {
    var mailEleve: String
    var nom: String
    var prenom: String
    var adresse: String
    var idNiv: String
    var niveau: String
    
    enum CodingKeys: String, CodingKey {
        case mailEleve
        case nom
        case prenom
        case adresse
        case idNiv
        case niveau
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.mailEleve = try valueContainer.decode(String.self, forKey: CodingKeys.mailEleve)
        self.nom = try valueContainer.decode(String.self, forKey: CodingKeys.nom)
        self.prenom = try valueContainer.decode(String.self, forKey: CodingKeys.prenom)
        self.adresse = try valueContainer.decode(String.self, forKey: CodingKeys.adresse)
        self.idNiv = try valueContainer.decode(String.self, forKey: CodingKeys.idNiv)
        self.niveau = try valueContainer.decode(String.self, forKey: CodingKeys.niveau)
    }
}
